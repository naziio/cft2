@extends('layouts.app')

@section('htmlheader_title')
Detalle de presupuesto
@endsection


@section('main-content')
<div class="container">
    <div class="container-narrow">
        <h2>Detalle presupuesto {{$presupuesto->nombrepresupuesto}}</h2>
        <div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Cargar Plantilla</h3>
                </div><!-- /.box-header -->

                <div id="notificacion_resul_fcdu"></div>

                <form  id="f_cargar_datos_presupuesto" name="f_cargar_datos_presupuesto" method="post"  action="cargar_datos2" class="formarchivo" enctype="multipart/form-data" >


                    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

                    <div class="box-body">



                        <div class="form-group col-xs-12"  >
                            <label>Agregar Archivo de Excel </label>
                            <input name="archivo" id="archivo" type="file"   class="archivo form-control"  required/><br /><br />
                        </div>
                        <input type="hidden" name="presupuesto" id="presupuesto" value="{{$presupuesto->id}}"/>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Cargar Datos</button>
                        </div>




                    </div>

                </form>

            </div>
            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Unidad</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                </tr>
                </thead>
                <tbody >
                @foreach ($nombrepu as $nombrepus)
                <tr id="nombrepu{{$nombrepus->id}}">
                    <td>{{$nombrepus->id}}</td>
                    <td>{{$nombrepus->nombrepu}}</td>
                    <td>{{$nombrepus->unidad}}</td>



                    <td>
                      @if($nombrepus->unidad)  <a href="{{ url('obra/preciounitario/index', [$nombrepus->id]) }}"> <button  class="btn btn-warning btn-xs btn-detail" value="{{$nombrepus->id}}">VER</button></a>
                        <a href="{{ route('cargar', [$nombrepus->id]) }}"> <button  class="btn btn-warning btn-xs btn-detail" value="{{$nombrepus->id}}">CARGAR PU</button></a>
                    </td>
                    @endif

                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
    </div>
            @stop