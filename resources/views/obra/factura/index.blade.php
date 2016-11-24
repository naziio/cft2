@extends('layouts.app')

@section('htmlheader_title')
Facturas
@endsection


@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />


<div class="container">
    <div class="container-narrow">
        <h2>Ingreso de factura</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary">Agregar FACTURA</button>
        <a href="{{ url('proveedor')}}"><button id="btn-add2" name="btn-add2" class="btn btn-primary">Agregar PROVEEDOR</button></a>

        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table table-bordered" id="factura">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Razon social</th>
                    <th>N° Factura</th>
                    <th>Subtotal</th>
                    <th>Recargo</th>
                    <th>Monto exento</th>
                    <th>Descuentos</th>
                    <th>Imp. especif.</th>
                    <th>Neto</th>
                    <th>IVA</th>
                    <th>Concepto</th>
                    <th>Obser.</th>

<th></th>
                    <th></th>
                </tr>
                </thead>
               <tbody id="factura-list" name="factura-list">
                @foreach ($factura as $facturas)
                <tr id="factura{{$facturas->id}}">
                    <td>{{$facturas->id}}</td>
                    <td>{{$facturas->razon_social}}</td>
                    <td>{{$facturas->num_factura}}</td>
                    <td>{{number_format($facturas->subtotal)}}</td>
                    <td>{{number_format($facturas->recargo)}}</td>
                    <td>{{number_format($facturas->monto_exento)}}</td>
                    <td>{{number_format($facturas->descuentos)}}</td>
                    <td>{{number_format($facturas->impuesto_especifico)}}</td>
                    <td>{{number_format($facturas->neto)}}</td>
                    <td>{{number_format($facturas->iva)}}</td>
                    <td>{{number_format($facturas->total_concepto)}}</td>
                    <td>{{$facturas->observacion}}</td>
                    <td>{{$facturas->created_at}}</td>
                    <td>


                        <a href="{{ route('detalle/index', $facturas) }}">  <button type="submit" class="btn btn-primary " value="{{$facturas->id}}">Cargar Datos</button></a>
                        <a href="{{ route('comparar/index', $facturas) }}">  <button type="submit" class="btn btn-primary " value="">COMPARAR</button></a>

                        <button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$facturas->id}}">Editar</button>
<!--                        <a href="{{ url('obra/factura/detalle/show', $facturas->id) }}"> <button class="btn btn-danger btn-xs" value="{{$facturas->id}}">Detalle</button></a>-->
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Razon social</th>

                    <th>N° Factura</th>
                    <th>Subtotal</th>
                    <th>Recargo</th>
                    <th>Monto exento</th>
                    <th>Descuentos</th>
                    <th>Imp. especif.</th>
                    <th>Neto</th>
                    <th>IVA</th>
                    <th>Concepto</th>
                    <th>Obser.</th>
<th></th>
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
                            <h4 class="modal-title" id="myModalLabel">Agregar Factura</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmfactura" name="frmfactura" class="form-horizontal" novalidate="">
                                <div class="form-group">
                                    <label for="razon_social" class="col-sm-3 control-label">Razon social</label>
                                    <div class="col-sm-9">
                                        {!! Form::select('razon_social', $proveedor,$selected,['class' => 'form-control', 'id'=> 'razon_social']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subtotal" class="col-sm-3 control-label">SUB TOTAL</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " id="subtotal" name="subtotal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="recargo" class="col-sm-3 control-label">Recargo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " id="recargo" name="recargo">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="num_factura" class="col-sm-3 control-label">N° Factura</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="num_factura" name="num_factura" placeholder="12345" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="monto_exento" class="col-sm-3 control-label">Exento</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " id="monto_exento" name="monto_exento">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descuentos" class="col-sm-3 control-label">Descuento</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " id="descuentos" name="descuentos">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="impuesto_especifico" class="col-sm-3 control-label">Imp. especifico</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="impuesto_especifico" name="impuesto_especifico" placeholder="" value="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="neto" class="col-sm-3 control-label">Neto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="neto" name="neto" placeholder="" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="iva" class="col-sm-3 control-label">IVA</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iva" name="iva" placeholder="" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="total_concepto" class="col-sm-3 control-label">Concepto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="total_concepto" name="total_concepto" placeholder="" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="observacion" class="col-sm-3 control-label">Observacion</label>
                                    <div class="col-sm-9">
                                        {!! Form::select('observacion', $nombrepu,$selected,['class' => 'form-control', 'id'=> 'observacion']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="obra_fk" class="col-sm-3 control-label">OBRA</label>
                                    <div class="col-sm-9">
                                        {!! Form::text('obra_fk',$obras,['class' => 'form-control', 'id' => 'obra_fk', 'readonly']) !!}
                                    </div>
                                </div>


                         <!--       <div class="form-group error">
                                    <label for="estado" class="col-sm-3 control-label">Estado</label>
                                    <div class="col-sm-9">
                                        <select id="estado" name="estado" class="form-control">
                                            <option value="pagado">Cancelado</option>
                                            <option value="pendiente">Pendiente</option>
                                        </select>

                                    </div>
                                </div>-->


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                            <input type="hidden" id="factura_id" name="factura_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/factura.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#factura').DataTable();
        });
    </script>
    </body>
    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>



</div>
@endsection