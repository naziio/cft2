@extends('layouts.app')

@section('htmlheader_title')
detalle
@endsection


@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<link href="{{asset('css/sweetalert.css')}}" rel="stylesheet">
<div class="container">
    <div class="container-narrow">
        <h2>Detalle de factura</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary">Agregar DETALLE</button>
<!--   <a href="{{ url('obra/factura/detalle/create', $factura)}}"> <button  class="btn btn-primary">Agregar Detalle Factura</button>-->
        <!--   </a> -->
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
            <table class="table" id="detalles">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                    <th>ITEM</th>
                    <th>Acciones</th>
 

                </tr>
                </thead>
<?
$total=0;
?>
                <tbody id="detalle-list" name="detalle-list" >
                @foreach ($detalle as $detalles)
                <tr id="detalle{{$detalles->id}}">
                    <td>{{$detalles->id}}</td>
                    <td>{{$detalles->nombrepu}}</td>
                    <td>{{$detalles->cantidad}}</td>
                    <td>{{number_format($detalles->precio_unitario)}}</td>
                    <td>{{number_format($detalles->cantidad*$detalles->precio_unitario)}} </td>
                    <td>{{$detalles->item_id}}</td>
                    <?
                    $total= $total + ($detalles->cantidad*$detalles->precio_unitario);
                    ?>
                    <td>
                      <button  class="btn btn-warning btn-xs open-modal" value="{{$detalles->id}}">Ver</button>
                       <button class="btn btn-danger btn-xs delete-detalle" value="{{$detalles->id}}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
                <?
                echo 'NETO: '.number_format($total);
                echo '</br>';
                $neto = $total*1.19;
                echo 'IVA: '.number_format($neto-$total);
                echo '</br>';
                echo 'TOTAL: '.number_format($neto) ;
                ?>
                </tbody>
                <tfoot>
                <th>ID</th>
                <th>Item</th>
                <th>cantidad</th>
                <th>Precio unitario</th>
                <th>Total</th>
                <th>ITEM</th>
                <th>Acciones</th>
                </tfoot>
            </table>
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
                                    <label for="item_id" class="col-sm-3 control-label">ITEM</label>
                                    <div class="col-sm-9">
                                        {!! Form::select('item_id',$item,array[],['class' => 'form-control', 'id' => 'item_id']) !!}
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
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->


    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/detalle.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#detalles').DataTable();
        });
    </script>
    </body>

    <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
</div>
@endsection