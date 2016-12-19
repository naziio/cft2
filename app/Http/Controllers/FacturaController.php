<?php

namespace App\Http\Controllers;

use App\DetalleFactura;
use App\Factura;
use App\NombrePU;
use App\Proveedor;
use Illuminate\Support\Facades\Auth;
use DB;

//use App\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;

class FacturaController extends Controller
{

    public function findFactura($id){
        $factura=Factura::findOrFail($id);
        return response()->json(compact('factura'));
    }



    public function index($obras)
    {
         // dd($obras);
        //$obras= $request->obras;
        $proveedor = Proveedor::all()
            ->pluck('name','name');
       /* $nombrepu = DB::table('nombrepu')
            ->join('factura', 'nombrepu.nombrepu', '=', 'factura.observacion')
            ->select('nombrepu.id','nombrepu.nombrepu', 'nombrepu.cantidad as cantidad1', 'nombrepu.preciounitario', 'nombrepu.total as total1', DB::raw('SUM(factura.subtotal) as subtotal'), DB::raw('SUM(factura.neto) as neto'), DB::raw('SUM(factura.iva)as iva') )
            ->groupby('nombrepu.nombrepu', 'cantidad1', 'nombrepu.preciounitario', 'total1')
            ->get();

        $factura = Factura::where('factura.obra_fk',$obras)
        ->select('factura.*')
        ->get();

        $detalle= DB::table('factura')
           ->where('factura.obra_fk',$obras)
        ->join('detalle_factura','factura.id','=','detalle_factura.factura_fk')
        ->select('factura.id', DB::RAW('SUM(detalle_factura.cantidad * detalle_factura.precio_unitario) as preciounitario2'),'detalle_factura.factura_fk')
        ->groupby('detalle_factura.factura_fk','factura.id')
        ->get();
        //dd($detalle);
*/
    /*  $prueba=  Factura::with('detalle')->select('factura.id', DB::RAW('SUM(detalle_factura.cantidad * detalle_factura.precio_unitario) as preciounitario2'),'detalle_factura.factura_fk')->groupby('detalle_factura.factura_fk','factura.id')
            ->get();*/
        $factura= Factura::with('detalle')
        ->where('factura.obra_fk',$obras)
        ->get();



       //dd($factura);
        $nombrepu = NombrePU::select('nombrepu')
        ->where('presupuesto_fk',$obras)
            ->pluck('nombrepu','nombrepu');
        $selected = array();


        return view('obra.factura.index',compact('factura','proveedor','selected','nombrepu','obras','detalle'));
       // return Response::json(compact('factura','proveedor','selected','nombrepu','obras'));
        //return view('obra.factura.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $factura=Factura::create($request->all());
        return Response::json($factura);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
//dd($request);
        $factura= new Factura($request->all());
        $factura->user_fk= Auth::id();
        //dd($factura);
        $factura->save();

        //var_dump($factura);
        return Response::json($factura);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($obras)
    {
       // $obras= $request->obras;
        $proveedor = Proveedor::all()
            ->pluck('name','name');
        $factura = Factura::join('detalle_factura','factura.id','=','detalle_factura.factura_fk')
            ->where('factura.obra_fk',$obras)
            ->select('factura.*','detalle_factura.cantidad as cantidad','detalle_factura.precio_unitario as preciounitario')
            ->get();
        $nombrepu = NombrePU::select('nombrepu')
            ->where('presupuesto_fk',$obras)
            ->pluck('nombrepu','nombrepu');
        $selected = array();
         return view('obra.factura.index',compact('factura','proveedor','selected','nombrepu','obras'));
      //  return Response::json(compact('factura','proveedor','selected','nombrepu','obras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $factura = Factura::findOrFail($id);
        return Response::json($factura);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $factura_id)
    {

        $factura = new Factura($request->all());

        $user = Auth::id();
        $factura = \App\Factura::findorfail($factura_id);

        $factura->razon_social = $request->razon_social;
       // $factura->subtotal = $request->subtotal;
        $factura->obra_fk = $request->obra_fk;
        $factura->recargo = $request->recargo;
        $factura->num_factura = $request->num_factura;
        $factura->monto_exento = $request->monto_exento;
       // $factura->descuentos = $request->descuentos;
        $factura->impuesto_especifico = $request->impuesto_especifico;
       // $factura->neto = $request->neto;
      //  $factura->iva = $request->iva;
      //  $factura->total_concepto = $request->total_concepto;
     //   $factura->observacion = $request->observacion;
        $factura->user_fk = $user;


        $factura->save();
                return Response::json($factura);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($factura_id)
    {
        $factura= factura::findOrFail($factura_id);
        $factura->delete();

        return Response::json($factura);
    }

}
