@extends('layouts.app')

@section('htmlheader_title')
   Comparar factura presupuesto
@endsection


@section('main-content')
<div class="container-fluid">
    <div class="col-md-8">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>
            <th>cantidad</th>
            <th>PU</th>
            <th>total</th>

        </tr>
        </thead>
        <tbody >
        @foreach ($nombrepu as $nombrepus)
        <tr>
            <td>{{$nombrepus->id}}</td>
            <td>{{$nombrepus->nombrepu}}</td>
            <td>{{$nombrepus->cantidad}}</td>
            <td>{{$nombrepus->preciounitario}}</td>
            <td>{{$nombrepus->total}}</td>
            @foreach($nombrepus->detalle as $detalle)
            @if($nombrepus->nombrepu == $detalle->nombrepu)
            {{ola}}
            @endif
            @endforeach
            @endforeach

            </tr>


        </tbody>


    </table>

</div>
</div>
@endsection