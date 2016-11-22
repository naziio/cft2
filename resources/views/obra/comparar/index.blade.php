

@extends('layouts.app')

@section('htmlheader_title')
Comparar
@endsection

@section('main-content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="comparar">
    <thead>
    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Total.</th>
        <th>PUF</th>
        <th>Cantidad</th>
        <th>TotalF</th>

    </tr>
    </thead>
    <tbody>
    <tr>
    @foreach($nombrepu as $nombrepus)
        <td>{{$nombrepus->id}}</td>
    @if($nombrepus->cantidad == '')
    <th>{{$nombrepus->nombrepu}}</th>
        @else
        <td>{{$nombrepus->nombrepu}}</td>
        @endif
    <td>{{$nombrepus->cantidad1}}</td>
    <td>{{$nombrepus->preciounitario}}</td>
    <td class="info">{{$nombrepus->total1}}</td>


        <td>{{$nombrepus->precio_unitario}}</td>
        <td>{{$nombrepus->cantidad}}</td>
        @if($nombrepus->total1<$nombrepus->total)
        <td class="danger">{{$nombrepus->total}}</td>
        @else
        <td class="success">{{$nombrepus->total}}</td>
        @endif





    </tr>

    @endforeach
     </tbody>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Total.</th>
        <th>PUF</th>
        <th>Cantidad</th>
        <th>TotalF</th>

    </tr>
    </tfoot>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function(){
        $('#comparar').DataTable();
    });
</script>

<a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
@endsection