@extends('layouts.app')

@section('htmlheader_title')
detalle
@endsection


@section('main-content')

<div class="container">
    <div class="container-narrow">
        <h2>Detalle de factura</h2>
        <a href="{{ url('obra/factura/detalle/create', $factura)}}"> <button id="btn-add" name="btn-add" class="btn btn-primary">Agregar Detalle Factura</button>
        </a>
        <div id="notificacion_resul_fcdu"></div>

        <form  id="f_cargar_datos_factura" name="f_cargar_datos_factura" method="post"  action="cargar_datos2" class="formarchivo" enctype="multipart/form-data" >

            <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

            <div class="box-body">

                <div class="form-group col-xs-12"  >
                    <label>Agregar Archivo de Excel </label>
                    <input name="archivo" id="archivo" type="file"   class="archivo form-control"  required/><br /><br />
                </div>
                <input type="hidden" name="factura" id="factura" value="{{$factura}}"/>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cargar Datos</button>
                </div>

            </div>
        </form>
    </div>
        <div>

            <!-- Table-to-load-the-data Part -->
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
                    <td>{{$detalles->nombrepu}}</td>
                    <td>{{$detalles->cantidad}}</td>
                    <td>{{number_format($detalles->precio_unitario)}}</td>
                    <td>{{number_format($detalles->total)}}</td>
                    <td>{{$detalles->created_at}}</td>
                    <td>
                        <a href="#"><button  class="btn btn-warning btn-xs " value="{{$detalles->id}}">Ver</button></a>
                        <a href="#"><button class="btn btn-danger btn-xs " value="{{$detalles->id}}">Eliminar</button></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->

    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/detalle.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    </body>

    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
</div>
@endsection