@extends('layouts.app')

@section('htmlheader_title')
Proveedores
@endsection


@section('main-content')
<div class="container">
    <div class="container-narrow">
        <h2>Registro de proveedores</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary ">Agregar PROVEEDOR</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>RUT</th>
                    <th>Razon social</th>
                    <th>Coreo</th>
                    <th>Direccion</th>


                </tr>
                </thead>
                <tbody id="proveedor-list" name="proveedor-list">
                @foreach ($proveedor as $proveedores)
                <tr id="proveedor{{$proveedores->id}}">
                    <td>{{$proveedores->id}}</td>
                    <td>{{$proveedores->rut}}</td>
                    <td>{{$proveedores->name}}</td>
                    <td>{{$proveedores->email}}</td>
                    <td>{{$proveedores->direccion}}</td>

                    <td>
                        <button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$proveedores->id}}">Editar</button>
                        <button class="btn btn-danger btn-xs btn-delete delete-proveedor" value="{{$proveedores->id}}" >Eliminar</button>


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
                            <h4 class="modal-title" id="myModalLabel">Agregar proveedor</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmproveedor" name="frmproveedor" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="rut" class="col-sm-3 control-label">RUT</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="rut" name="rut" placeholder="12345-9" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="name" class="col-sm-3 control-label">Nombre o Razon social</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="EJ: SODIMAC" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="email" class="col-sm-3 control-label">Correo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="email" name="email" placeholder="contacto@sodimac.cl" value="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="direccion" class="col-sm-3 control-label">Direccion</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="av. Vitacura #1456" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                            <input type="hidden" id="proveedor_id" name="proveedor_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/proveedor.js')}}"></script>

    </body>


</div>
@endsection
