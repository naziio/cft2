<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Excel;
use DB;
use App\Presupuesto;
use App\NombrePU;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;

class NombrePUController extends Controller
{
   public function index($presupuestos)
   {

       $presupuesto=Presupuesto::find($presupuestos);
//dd($presupuesto->id);

       $nombrepu= NombrePU::select('id','nombrepu','unidad')
           ->where('presupuesto_fk',$presupuesto->id)
           ->get();

       //dd($nombrepu);

       // $nombrepu= set_path($nombrepu);
       return view('obra.nombrepu.index',compact('nombrepu','presupuesto'));
   }

    public function create(Request $request)
    {
        $nombrepu= new NombrePU($request->all());
        $nombrepu->save();

        //var_dump($factura);
        return Response::json($nombrepu);
    }

    public function store(Request $request)
    {
        $nombrepu= new NombrePU($request->all());
        $nombrepu->presupuesto_fk= $request->presupuesto_id;
        $nombrepu->save();
        //var_dump($factura);
        return Response::json($nombrepu);
    }

    public function show($nombrepu_id){


        $nombrepu = NombrePU::find($nombrepu_id);

        return Response::json($nombrepu);
    }

    public function update($nombrepu_id)
    {
        $nombrepu = NombrePU::find($nombrepu_id);
        $nombrepu->save();
        return Response::json($nombrepu);
        
    }
    

    public function cargar_datos2(Request $request)
    {
        $presupuesto=$request->presupuesto;
        //dd($presupuesto);
        $archivo = $request->file('archivo');
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
        $ruta  =  storage_path("app/public/$nombre_original");

        if($r1){

            Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) use($presupuesto) {


                $hoja->each(function($fila) use($presupuesto) {

                    $nombrepu=new NombrePU();
                    $nombrepu->nombrepu=$fila->nombrepu;
                    $nombrepu->unidad= $fila->unidad;
                    $nombrepu->presupuesto_fk=$presupuesto;
                    $nombrepu->save();


                });

            });

            return redirect("presupuesto")->with("msj"," Nombres Cargados Correctamente");

        }
        // else
        //  {
        // return view("")->with("msj","Error al subir el archivo");
        //  }

    }
}