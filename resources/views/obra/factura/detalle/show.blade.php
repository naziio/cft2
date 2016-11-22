@extends('layouts.app')

@section('htmlheader_title')
detalle
@endsection


@section('main-content')

<div class="container">
    <div class="container-narrow">
        <h2>Detalle de factura</h2>
<!--        id="btn-add" name="btn-add"-->
        <button class="btn btn-primary">Agregar Detalle Factura</button></a>
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
                    <td>{{$detalles->precio_unitario}}</td>
                    <td>{{$detalles->total}}</td>
                    <td>{{$detalles->created_at}}</td>
                    <td>
                        <a href="#"><button  class="btn btn-warning btn-xs btn-detail" value="{{$detalles->id}}">Editar</button></a>
                        <a href="#"><button class="btn btn-danger btn-xs btn-delete " value="{{$detalles->id}}">Eliminar</button></a>
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
                            <h4 class="modal-title" id="myModalLabel">Agregar Detalle detalle</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmdetalle" name="frmdetalle" class="form-horizontal" novalidate="">


                                <div class="form-group">
                                    <label for="nombrepu" class="col-sm-3 control-label">Descripcion</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " id="nombrepu" name="nombrepu">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cantidad" class="col-sm-3 control-label">Cantidad</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " id="cantidad" name="cantidad">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="precio_unitario" class="col-sm-3 control-label">Precio unitario</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="precio_unitario" name="precio_unitario" placeholder="" value="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="total" class="col-sm-3 control-label">Total</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="total" name="total" placeholder="" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="factura_fk" class="col-sm-3 control-label">Factura</label>
                                   <div class="col-sm-9">
                                        {!! Form::text('factura_fk',$factura,['class' => 'form-control', 'id' => 'factura_fk', 'readonly']) !!}
                                    </div>
                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                            <input type="hidden" id="detalle_id" name="detalle_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/detalle.js')}}"></script>
    </body>
    <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>


</div>
@endsection