@extends('layouts.app')

@section('htmlheader_title')
Personal CFT
@endsection


@section('main-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

<div class="container">

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


    <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
</div>

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/personal.js')}}"></script>

</body>


</div>
<script>
    $(document).ready(function(){
        $('#personal').DataTable();
    });
</script>
@endsection