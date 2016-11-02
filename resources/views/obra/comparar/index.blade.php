@extends('layouts.app')

@section('htmlheader_title')
   Comparar factura presupuesto
@endsection


@section('main-content')
<div class="container-fluid">
    <div class="col-md-6">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody >
        @foreach ($nombrepu as $nombrepus)
            <tr id="nombrepu{{$nombrepus->id}}">
                <td>{{$nombrepus->id}}</td>
                <td>{{$nombrepus->nombrepu}}</td>
                @endforeach
            </tr>

        </tbody>


    </table>

    </div>
        <div class="col-md-6">
            <br/>
           <table class="table table-responsive">
               <thead>
               <tr>
               <th>PU Factura</th>
               <th>Cantidad</th>
               <th>Total</th>
                   <th>IVA</th>
               </tr>
               </thead>
               <tbody>

                @foreach ($detalle as $detalles)
                <tr>
                <td>{{$detalles->cantidad}}</td>
                <td>{{$detalles->precio_unitario}}</td>
                <td>{{$detalles->total}}</td>
               @endforeach
               </tr>
        </tbody>
    </table>
</div>
</div>

@endsection