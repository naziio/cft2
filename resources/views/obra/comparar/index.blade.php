@extends('layouts.app')

@section('htmlheader_title')
   Comparar factura presupuesto
@endsection


@section('main-content')
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>


        </tr>
        </thead>
        <tbody >
        @foreach ($detalle as $detalles)
            <tr id="detalle{{$detalles->id}}">
                <td>{{$detalles->id}}</td>
                <td>{{$detalles->id_producto}}</td>
                <td>{{$detalles->cantidad}}</td>
                <td>{{$detalles->precio_unitario}}</td>
                <td>{{$detalles->total}}</td>
                <td>{{$detalles->created_at}}</td>
                <td>
                    <a href="#"><button  class="btn btn-warning btn-xs " value="{{$detalles->id}}">Ver</button></a>
                    <a href="#"><button class="btn btn-danger btn-xs " value="{{$detalles->id}}">Eliminar</button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection