<?php

namespace App\Http\Controllers;

use App\DetalleFactura;
use App\Factura;
use App\NombrePU;
use App\Proveedor;
use Illuminate\Support\Facades\Auth;

//use App\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;

class FacturaController extends Controller
{
    public function index($obras)
    {

        $proveedor = Proveedor::all()
            ->pluck('name','name');
        $factura = Factura::where('obra_fk',$obras)
        ->get();
        $nombrepu = NombrePU::select('nombrepu')
        ->where('presupuesto_fk',$obras)
            ->pluck('nombrepu','nombrepu');
        $selected = array();
        return view('obra.factura.index',compact('factura','proveedor','selected','nombrepu','obras'));
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
    public function show($factura_id)
    {
        $factura = Factura::find($factura_id);
        return Response::json($factura);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($factura_id)
    {
        $factura = Factura::find($factura_id);
        return Response::json($factura);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($factura_id)
    {

        $factura =Factura::findOrfail($factura_id);
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
