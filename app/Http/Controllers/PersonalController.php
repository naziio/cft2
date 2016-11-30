<?php

namespace App\Http\Controllers;

use App\Obra;
use Illuminate\Http\Request;
use App\Personal;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;

class PersonalController extends Controller
{
    public function index()
    {
        $personal= Personal::all();
        $obra_fk= Obra::all()
            ->pluck('name','id');
        $selected = array();

        return view('personal.index',compact('personal','obra_fk','selected'));

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
        $personal->estado = $request->estado;
        $personal->obra_fk = $request->obra_fk;
        $personal->save();
        return Response::json($personal);
    }

    public function destroy($personal_id)
    {
        $personal= Personal::destroy($personal_id);
        return Response::json($personal);
    }

    public function ver($obras)
    {
        $personal= Personal::select('*')
            ->where('obra_fk', $obras)
            ->get();
        return view('personal.ver', compact('personal'));
    }


}
