@extends('layouts.app')

@section('htmlheader_title')
Cargar
@endsection


@section('main-content')
<div class="col-md-8">


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


                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="{{$presupuestos->id}}">Cargar Datos</button>
                </div>




            </div>

        </form>

    </div>

</div>

@stop