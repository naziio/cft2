@extends('layouts.app')

@section('htmlheader_title')
Detalle
@endsection


@section('main-content')

<div class="container">
    <div class="container-narrow">
        <h2>Detalle de factura</h2>


        {!! Form::open(['route'=>'detalle/store', 'method'=>'POST'])!!}


        <div class="form-group">
            <label for="nombrepu" class="col-sm-3 control-label">Descripcion</label>
            <div class="col-sm-9">
                {!! Form::select('nombrepu', $nombrepu,$selected,['class' => 'form-control', 'id'=> 'nombrepu']) !!}
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


        <button type="submit" class="btn btn-primary">Registrar detalle!</button>
        {!!Form::close() !!}

       </div>
</div>

@endsection