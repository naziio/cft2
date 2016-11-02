<?php

namespace App\Http\Controllers;

use App\Obra;
use App\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;

class ObraController extends Controller
{
    public function index()
    {
        $obra = Obra::all();
        $nombre= Presupuesto::all()
            ->pluck('nombrepresupuesto','nombrepresupuesto');
        
        $selected = array();
        return view('obra.obra.index',compact('obra', 'nombre','selected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $obra = Obra::create($request->all());
        return Response::json($obra);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $obra = new Obra($request->all());
        $obra->save();
        return Response::json($obra);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($obra_id)
    {
        $obra = Obra::find($obra_id);
        return view('obra.obra.show',compact('obra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($obra_id)
    {
        $obra= Obra::find($obra_id);

        return Response::json($obra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $obra_id)
    {
        $obra = new Obra($request->all());

        $obra = \App\Obra::find($obra_id);

        $obra->name = $request->name;
        $obra->direccion = $request->direccion;
        $obra->telefono = $request->telefono;
        $obra->fecha = $request->fecha;
        $obra->save();
        return Response::json($obra);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($obra_id,Request $request)
    {

    }
}
