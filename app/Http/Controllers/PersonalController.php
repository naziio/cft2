<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;

class PersonalController extends Controller
{
    public function index()
    {
        $personal= Personal::all();

        return view('personal.index')->with('personal',$personal);

    }

    public function create(Request $request)
    {
        $personal=Personal::create($request->all());
        return Response::json($personal);
    }

    public function store(Request $request)
    {
        $personal = new Personal($request->all());
        $personal->save();
        return Response::json($personal);
    }

    public function show($personal_id)
    {
        $personal = personal::find($personal_id);
        return Response::json($personal);

    }

    public function edit($personal_id)
    {
        $personal = personal::find($personal_id);
        return Response::json($personal);
    }

    public function update(Request $request, $personal_id)
    {
        $personal = new Personal($request->all());

        $personal = \App\personal::find($personal_id);

        $personal->nombre = $request->nombre;
        $personal->apellidos = $request->apellidos;
        $personal->rut = $request->rut;
        $personal->nacionalidad = $request->nacionalidad;
        $personal->estado_civil = $request->estado_civil;
        $personal->fecha_nac = $request->fecha_nac;
        $personal->direccion = $request->direccion;
        $personal->comuna = $request->comuna;
        $personal->telefono = $request->telefono;
        $personal->prevision = $request->prevision;
        $personal->afp = $request->afp;
        $personal->fecha_ingreso = $request->fecha_ingreso;
        $personal->faena_termino = $request->faena_termino;
        $personal->sueldo_liquido = $request->sueldo_liquido;
        $personal->calzado = $request->calzado;
        $personal->cargo = $request->cargo;
        $personal->save();
        return Response::json($personal);
    }

    public function destroy()
    {

    }

}
