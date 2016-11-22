@extends('layouts.app')

@section('htmlheader_title')
Presupuesto
@endsection


@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

<div class="container">
    <div class="container-narrow">
        <h2>Presupuesto</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Nuevo presupuesto</button
            </br>
        <div>
            </br>
            <!-- Table-to-load-the-data Part -->
            <table class="table table-bordered" id="presupuesto">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Presupuesto</th>
                    <th>Detalle</th>
                </tr>
                </thead>
                <tbody >
                @foreach ($presupuesto as $presupuestos)
                <tr id="presupuesto{{$presupuestos->id}}">
                    <td>{{$presupuestos->id}}</td>
                    <td>{{$presupuestos->nombrepresupuesto}}</td>
                    <td>

                        <a href="{{ route('nombrepu', [$presupuestos->id]) }}"> <button  class="btn btn-warning btn-xs btn-detail" value="{{$presupuestos->id}}">VER</button></a>
                        <button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$presupuestos->id}}">Editar</button>
                        <button class="btn btn-danger btn-xs btn-delete delete-obra" value="{{$presupuestos->id}}" >Eliminar</button>


                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar presupuesto</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmpresupuesto" name="frmpresupuesto" class="form-horizontal" novalidate="">


                                <div class="form-group error">
                                    <label for="nombrepresupuesto" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="nombrepresupuesto" name="nombrepresupuesto" placeholder="MEGA" value="">
                                    </div>
                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                            <input type="hidden" id="presupuesto_id" name="presupuesto_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
            </div>

        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="{{asset('js/presupuesto.js')}}"></script>
        <script>
            $(document).ready(function(){
                $('#presupuesto').DataTable();
            });
        </script>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
</div>
            @stop