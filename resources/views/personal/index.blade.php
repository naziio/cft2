@extends('layouts.app')

@section('htmlheader_title')
Personal CFT
@endsection


@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

<div class="container">
    <div class="container-narrow">
        <h2>Registro de Personal</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary">Agregar personal</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <div class="table-responsive">
            <table class="table table-bordered" id="personal">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rut</th>
                    <th>Nacionalidad</th>
                    <th>Estado civil</th>
                    <th>Fecha de nacimiento</th>
                    <th>Direccion</th>
                    <th>Comuna</th>
                    <th>Telefono</th>
                    <th>Prevision</th>
                    <th>AFP</th>
                    <th>Fecha ingreso</th>
                    <th>Faena de termino</th>
                    <th>Sueldo liquido</th>
                    <th>N° calzado</th>
                    <th>Cargo</th>
                    <th>Obra</th>
                    <th>Estado</th>

                </tr>
                </thead>
                <tbody id="personal-list" name="personal-list">
                @foreach ($personal as $personals)
                <tr id="personal{{$personals->id}}">
                    <td>{{$personals->id}}</td>
                    <td>{{$personals->nombre}}</td>
                    <td>{{$personals->apellidos}}</td>
                    <td>{{$personals->rut}}</td>
                    <td>{{$personals->nacionalidad}}</td>
                    <td>{{$personals->estado_civil}}</td>
                    <td>{{$personals->fecha_nac}}</td>
                    <td>{{$personals->direccion}}</td>
                    <td>{{$personals->comuna}}</td>
                    <td>{{$personals->telefono}}</td>
                    <td>{{$personals->prevision}}</td>
                    <td>{{$personals->afp}}</td>
                    <td>{{$personals->fecha_ingreso}}</td>
                    <td>{{$personals->faena_termino}}</td>
                    <td>{{$personals->sueldo_liquido}}</td>
                    <td>{{$personals->calzado}}</td>
                    <td>{{$personals->cargo}}</td>
                    <td>{{$personals->obra_fk}}</td>
                    <td>{{$personals->estado}}</td>

                    <td>
                        <button  class="btn btn-warning btn-xs btn-detail open-modal" value="{{$personals->id}}">Editar</button>
                        <button class="btn btn-danger btn-xs btn-delete delete-personal" value="{{$personals->id}}" >Eliminar</button>


                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rut</th>
                    <th>Nacionalidad</th>
                    <th>Estado civil</th>
                    <th>Fecha de nacimiento</th>
                    <th>Direccion</th>
                    <th>Comuna</th>
                    <th>Telefono</th>
                    <th>Prevision</th>
                    <th>AFP</th>
                    <th>Fecha ingreso</th>
                    <th>Faena de termino</th>
                    <th>Sueldo liquido</th>
                    <th>N° calzado</th>
                    <th>Cargo</th>
                    <th>Obra</th>
                    <th>Estado</th>

                </tr>
                </tfoot>
            </table>
            </div>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar personal</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmpersonal" name="frmpersonal" class="form-horizontal" novalidate="">


                                <div class="form-group error">
                                    <label for="nombre" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="nombre" name="nombre" placeholder="José" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="apellidos" class="col-sm-3 control-label">Apellidos</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="apellidos" name="apellidos" placeholder="Martinez Martinez" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="rut" class="col-sm-3 control-label">Rut</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="rut" name="rut" placeholder="18.328.328-8" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nacionalidad" class="col-sm-3 control-label">Nacionalidad</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Chileno" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="estado_civil" class="col-sm-3 control-label">Estado civil</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="estado_civil" name="estado_civil" placeholder="Soltero" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="fecha_nac" class="col-sm-3 control-label">Fecha nacimiento</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control has-error" id="fecha_nac" name="fecha_nac" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="direccion" class="col-sm-3 control-label">Direccion</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="direccion" name="direccion" placeholder="Mateo de toro y zambrano" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="comuna" class="col-sm-3 control-label">Comuna</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="comuna" name="comuna" placeholder="La reina" value="">
                                    </div>
                                </div>

                                <div class="form-group error">
                                    <label for="telefono" class="col-sm-3 control-label">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="telefono" name="telefono" placeholder="77010127" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="prevision" class="col-sm-3 control-label">Prevision</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="prevision" name="prevision" placeholder="FONASA" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="afp" class="col-sm-3 control-label">AFP</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="afp" name="afp" placeholder="MODELO" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="fecha_ingreso" class="col-sm-3 control-label">Fecha inicio</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control has-error" id="fecha_ingreso" name="fecha_ingreso" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="faena_termino" class="col-sm-3 control-label">Faena de termino</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="faena_termino" name="faena_termino" placeholder="" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="sueldo_liquido" class="col-sm-3 control-label">Sueldo liquido</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="sueldo_liquido" name="sueldo_liquido" placeholder="$300.000" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="calzado" class="col-sm-3 control-label">N° calzado</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="calzado" name="calzado" placeholder="43" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="cargo" class="col-sm-3 control-label">Cargo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="cargo" name="cargo" placeholder="Jornal" value="">
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="obra_fk" class="col-sm-3 control-label">Obra</label>
                                    <div class="col-sm-9">
                                        {!! Form::select('obra_fk', $obra_fk,$selected,['class' => 'form-control', 'id'=> 'obra_fk']) !!}
                                    </div>
                                </div>
                                <div class="form-group error">
                                    <label for="estado" class="col-sm-3 control-label">Estado</label>
                                    <div class="col-sm-9">

                                        {!! Form::select('estado', array('vigente' => 'Vigente', 'no_vigente' => 'No vigente'),'vigente',['class' => 'form-control', 'id'=> 'estado']) !!}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                            <input type="hidden" id="personal_id" name="personal_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/personal.js')}}"></script>

    </body>

    <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
</div>
<script>
    $(document).ready(function(){
        $('#personal').DataTable();
    });
</script>

@endsection