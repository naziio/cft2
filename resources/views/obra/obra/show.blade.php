@extends('layouts.app')

@section('htmlheader_title')
Obras
@endsection


@section('main-content')
<div class="container">
    <div class="container-narrow">
        <h2>OBRA </h2>
          <div>

              <div>
                  <p>Ver FACTURAS</p> <a href="{{ url('obra/factura/index', [$obra->id]) }}"><button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$obras->id}}">Editar</button></a>
              </div>
            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Fecha inicio</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($factura as $facturas)
                <tr id="factura{{$facturas->id}}">
                    <td>{{$facturas->id}}</td>
                    <td>{{$facturas->name}}  <button  class="btn btn-primary btn-xs btn-detail" value="{{$facturas->id}}">VER</button></td>
                    <td>{{$facturas->direccion}}</td>
                    <td>{{$facturas->telefono}}</td>
                    <td>{{$facturas->fecha}}</td>
                    <td>
                        <a href="#"><button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$obras->id}}">Detalle</button></a>



                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar obra</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmobra" name="frmobra" class="form-horizontal" novalidate="">


                                <div class="form-group error">
                                    <label for="name" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="UFT" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="direccion" class="col-sm-3 control-label">Direccion</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="av. Vitacura #1456" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="telefono" class="col-sm-3 control-label">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="telefono" name="telefono" placeholder="77010127" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="fecha" class="col-sm-3 control-label">Fecha inicio</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control has-error" id="fecha" name="fecha" placeholder="" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                            <input type="hidden" id="obra_id" name="obra_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/obra.js')}}"></script>

    </body>


</div>
@endsection