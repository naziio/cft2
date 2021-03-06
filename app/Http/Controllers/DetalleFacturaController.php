<?php

namespace App\Http\Controllers;

use App\DetalleFactura;
use App\Factura;
use DB;

use Illuminate\Support\Facades\Auth;
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
        $detalle = DetalleFactura::select('id','nombrepu','cantidad','precio_unitario','total','item_id')
            ->where('factura_fk',$factura)
            ->get();
        $obra= Factura::find($factura);
        $obra= $obra->obra_fk;

        $item = NombrePU::select('id')
            ->where('presupuesto_fk',$obra)
            ->pluck('id','id');
        dd($item);
        return view('obra.factura.detalle.index', compact('factura','detalle','item'));
    }


    public function create(Request $request)
    {
    /*    $obra=Factura::select('obra_fk')
            ->where('id',$factura)
        ->pluck('obra_fk','obra_fk');


        $nombrepu= NombrePU::select('nombrepu')
            ->where('presupuesto_fk',$obra)
            ->pluck('nombrepu','nombrepu');

    */
        //$selected = array();

        //return view('obra.factura.detalle.create', compact('factura','nombrepu','selected'));
        $detalle=DetalleFactura::create($request->all());
        return Response::json($detalle);
    }

    public function store(Request $request)
    {
        //dd($request);

       $obradetalle=$request->factura_fk;


        $detalle= new DetalleFactura($request->all());
        $detalle->user_fk= Auth::id();
        $detalle->save();


        return Response::json($detalle);

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
    public function update($detalle_id, Request $request)
    {
        $user = Auth::id();
        $detalle = \App\DetalleFactura::findorfail($detalle_id);

        $detalle->nombrepu = $request->nombrepu;
        $detalle->cantidad = $request->cantidad;
        $detalle->precio_unitario = $request->precio_unitario;
        $detalle->factura_fk = $request->factura_fk;
        $detalle->item_id = $request->item_id;
        $detalle->user_fk = $user;


       // $detalle =DetalleFactura::findOrfail($detalle);

        $detalle->save();
        return Response::json($detalle);
    }

    public function show($detalle)
    {
        $detalle = DetalleFactura::find($detalle);
        return Response::json($detalle);
    }


    public function destroy($detalle_id)
    {

        $detalle= DetalleFactura::findorfail($detalle_id);
        $detalle->delete();
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


        return view('obra.comparar.index2', compact('nombrepu'));
    }

    public function index1($factura)
    {
        $obra= Factura::find($factura);
        $obra= $obra->obra_fk;

       $nombrepu = DB::table('nombrepu')
            ->join('factura', 'nombrepu.nombrepu', '=', 'factura.observacion')
           ->select('nombrepu.id','nombrepu.nombrepu', 'nombrepu.cantidad as cantidad1', 'nombrepu.preciounitario', 'nombrepu.total as total1', DB::raw('SUM(factura.subtotal) as subtotal'), DB::raw('SUM(factura.neto) as neto'), DB::raw('SUM(factura.iva)as iva') )
           ->groupby('nombrepu.nombrepu', 'cantidad1', 'nombrepu.preciounitario', 'total1')
           ->get();
        return view('obra.comparar.index', compact('nombrepu'));
    }


}

