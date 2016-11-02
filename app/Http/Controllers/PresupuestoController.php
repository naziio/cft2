<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presupuesto;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;

class PresupuestoController extends Controller
{

    public function index()
    {
       $presupuesto= Presupuesto::all();
       // $presupuesto= set_path($presupuesto);
        return view('obra.presupuesto.index')->with('presupuesto', $presupuesto);
    }

    public function create(Request $request)
    {
        $presupuesto= new Presupuesto($request->all());
        $presupuesto->save();

        //var_dump($factura);
        return Response::json($presupuesto);
    }

    public function store(Request $request)
    {
        $presupuesto= new Presupuesto($request->all());
        $presupuesto->save();

        //var_dump($factura);
        return Response::json($presupuesto);
    }

    public function show($presupuesto_id){


        $presupuesto = Presupuesto::find($presupuesto_id);
        return Response::json($presupuesto);
    }

public function update($presupuesto_id)
{
    $presupuesto = Presupuesto::find($presupuesto_id);
    $presupuesto->save();
    return Response::json($presupuesto);
}
}
