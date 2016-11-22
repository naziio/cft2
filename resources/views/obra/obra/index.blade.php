@extends('layouts.app')

@section('htmlheader_title')
Obras
@endsection


@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

<div class="container">
    <div class="container-narrow">
        <h2>Registro de OBRAS</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary">Agregar OBRA</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table" id="obras">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Fecha inicio</th>
                    <th>Personal</th>
<th></th>
                </tr>
                </thead>
                <tbody id="obra-list" name="obra-list">
                @foreach ($obra as $obras)
                <tr id="obra{{$obras->id}}">
                    <td>{{$obras->id}}</td>
                    <td>{{$obras->name}} <a href="{{ url('obra/factura/index', $obras->id)}}"><button  class="btn btn-primary btn-xs btn-detail" value="{{$obras->id}}">VER</button></a></td>
                    <td>{{$obras->direccion}}</td>
                    <td>{{$obras->telefono}}</td>
                    <td>{{$obras->fecha}}</td>
                    <td><a href="{{ url('personal/ver', $obras->id)}}"><button  class="btn btn-primary btn-xs btn-detail" value="{{$obras->id}}">Personal</button></a></td>
                    <td>
                        <button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$obras->id}}">Editar</button>
                        <button class="btn btn-danger btn-xs btn-delete delete-obra" value="{{$obras->id}}" >Eliminar</button>


                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Fecha inicio</th>
                    <th>Personal</th>
                    <th></th>
                </tr>
                </tfoot>
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

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        {!! Form::select('name', $nombre,$selected,['class' => 'form-control', 'id'=> 'name']) !!}
                                    </div>
                                </div>
                              {{--  <div class="form-group error">
                                    <label for="name" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="UFT" value="">
                                    </div>
                                </div>--}}

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

    <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
</div>
<script>
    $(document).ready(function(){
        $('#obras').DataTable();
    });
</script>

@endsection