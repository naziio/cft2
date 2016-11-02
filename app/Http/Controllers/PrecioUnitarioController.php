<?php

namespace App\Http\Controllers;

use App\NombrePU;
use Illuminate\Http\Request;
use App\PrecioUnitario;
use Illuminate\Support\Facades\Response;
use Excel;
use Storage;


use App\Http\Requests;

class PrecioUnitarioController extends Controller
{
   public function index($nombrepus){

       $nombrepu=NombrePU::find($nombrepus);
       $preciounitario= PrecioUnitario::select('item','cantidad','preciounitario','total')
           ->where('nombrepu',$nombrepu->id)
           ->get();

       return view('obra.preciounitario.index',compact('preciounitario'));
   }

    public function create(Request $request){

        $preciounitario = PrecioUnitario::create($request);
        return Response::json($preciounitario);
    }

    public function store(Request $request){

        $preciounitario = new PrecioUnitario($request->all());
        $preciounitario->save();

        return Response::json($preciounitario);
    }

    public function show($nombrepus)
    {
        $nombrepu=NombrePU::find($nombrepus);
        $preciounitario= PrecioUnitario::select('item','cantidad','subtotal','total')
            ->where('nombrepu',$nombrepu->id)
            ->get();

        return view('obra.preciounitario.index',compact('preciounitario'));
    }

    public function edit(){}

    public function update(){}

    public function delete(){}


    /*VISTA PARA SUBIR EL EXCEL*/
    public function cargar($nombrepus){

        $nombrepu=NombrePU::find($nombrepus);
        return view('excel',compact('nombrepu'));
    }
    /*CARGA DATOS DE EXCEL A BD DE PRECIOUNITARIO*/

    public function cargar_datos(Request $request)
    {
        $nombrepu= $request->nombrepu;

        $archivo = $request->file('archivo');
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
        $ruta  =  storage_path("app/public/$nombre_original");

        if($r1){

            Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) use ($nombrepu) {

                $hoja->each(function($fila) use ($nombrepu) {
                        $preciounitario=new PrecioUnitario;
                        $preciounitario->item= $fila->item;
                        $preciounitario->cantidad= $fila->cantidad;
                        $preciounitario->preciounitario= $fila->preciounitario;
                       $preciounitario->rend= $fila->rend;
                       $preciounitario->perd= $fila->perd;
                        $preciounitario->total= $fila->total;
                       $preciounitario->nombrepu=$nombrepu;
                        $preciounitario->save();


                });

            });

            return redirect("presupuesto")->with("message"," Precios Cargados Correctamente");

        }
       else
       {
            return view("presupuesto")->with("message","Error al subir el archivo");
        }

    }
}

