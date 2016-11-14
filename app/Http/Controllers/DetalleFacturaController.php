<?php

namespace App\Http\Controllers;

use App\DetalleFactura;
use App\Factura;

use App\NombrePU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;

class DetalleFacturaController extends Controller
{
    public function index($facturas)
    {

       // $factura = Factura::find($request->id);
        $factura = $facturas;
        $detalle = DetalleFactura::select('id','id_producto','cantidad','precio_unitario','total')
            ->where('factura_fk',$factura)
            ->get();

        return view('obra.factura.detalle.index', compact('factura','detalle'));
    }


    public function create($factura)
    {
        $obra=Factura::select('obra_fk')
            ->where('id',$factura)
        ->pluck('obra_fk','obra_fk');


        $id_producto= NombrePU::select('nombrepu')
            ->where('presupuesto_fk',$obra)
            ->pluck('nombrepu','nombrepu');
        $selected = array();

        return view('obra.factura.detalle.create', compact('factura','id_producto','selected'));
    }

    public function store(Request $request)
    {


        $detalle= new DetalleFactura($request->all());
        $detalle->save();
        return view('obra.obra.index');

    }
    public function edit($detalle)
    {
        $detalle = DetalleFactura::find($detalle);
        return Response::json($detalle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($detalle)
    {

        $detalle =DetalleFactura::findOrfail($detalle);
        $detalle->save();
        return Response::json($detalle);
    }

    public function show($detalle)
    {
        $detalle = Factura::find($detalle);
        return Response::json($detalle);
    }



    public function cargar_datos2(Request $request)
    {
        $factura=$request->factura;
        //dd($presupuesto);
        $archivo = $request->file('archivo');
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
        $ruta  =  storage_path("app/public/$nombre_original");

        if($r1){

            Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) use($factura) {


                $hoja->each(function($fila) use($factura) {

                    $detalle=new detalle();
                    $detalle->detalle=$fila->detalle;
                    $detalle->unidad= $fila->unidad;
                    $detalle->factura_fk=$factura;
                    $detalle->save();


                });

            });

            return redirect("obra/factura/detalle")->with("msj"," detalles Cargados Correctamente");

        }
    }

    public function comparar($factura)
    {

        $obra=Factura::select('obra_fk')
            ->where('id',$factura)
            ->pluck('obra_fk','obra_fk');


        $id_producto= NombrePU::select('nombrepu')
            ->where('presupuesto_fk',$obra)
            ->pluck('nombrepu','nombrepu');
        $selected = array();


        $detalle= DetalleFactura::select('id')
        ->where('factura_fk', $factura)
            ->get();
        //dd($detalle);
       $nombrepu=NombrePU::where('presupuesto_fk', $obra)
           ->get();
        $comparar = DetalleFactura::where('nombrepu',$id_producto)
            ->toSql();


        return view('obra.comparar.index', compact('nombrepu'));
    }
}

