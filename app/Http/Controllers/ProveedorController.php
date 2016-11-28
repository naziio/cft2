<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedor = Proveedor::all();

        return view('proveedores.index')->with('proveedor',$proveedor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        $proveedor = \App\Proveedor::create($request->all());

        return Response::json($proveedor);
        //return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {


        $proveedor = new Proveedor($request->all());
        $proveedor->save();
        return Response::json($proveedor);


       // $this->pago= new pago($request->all());
//dd($proveedor_id);
           /* $proveedor = new Proveedor($request->all());
          dd($proveedor);
            $proveedor->rut = $request->rut;
            $proveedor->name = $request->name;
            $proveedor->email = $request->email;
            $proveedor->direccion = $request->direccion;
            $proveedor->save();

            return Response::json($proveedor);*/


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($proveedor_id)
    {

        $proveedor = Proveedor::find($proveedor_id);

        return Response::json($proveedor);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($proveedor_id)
    {

     $proveedor = Proveedor::find($proveedor_id);

     return Response::json($proveedor);
 }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$proveedor_id)
    {
        $proveedor = new Proveedor($request->all());

        $proveedor = \App\Proveedor::find($proveedor_id);
        $proveedor->rut = $request->rut;
        $proveedor->name = $request->name;
        $proveedor->email = $request->email;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
        return Response::json($proveedor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($proveedor_id)
    {
        $proveedor= Proveedor::destroy($proveedor_id);
        return Response::json($proveedor);
    }

}
