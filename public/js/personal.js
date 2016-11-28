/**
 * Created by CONSTRUCTORA CFT on 29-09-16.
 */
$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    }

})

$(document).ready(function(){

    var url = "personal";

    //display modal form for personal editing

    $('#personal-list').on('click', '.open-modal',function(){
        var personal_id = $(this).val();

        $.get(url + '/' + personal_id, function (data) {
            //success data
            console.log(data);
            $('#personal_id').val(data.id);
            $('#nombre').val(data.nombre);
            $('#apellidos').val(data.apellidos);
            $('#rut').val(data.rut);
            $('#nacionalidad').val(data.nacionalidad);
            $('#estado_civil').val(data.estado_civil);
            $('#fecha_nac').val(data.fecha_nac);
            $('#direccion').val(data.direccion);
            $('#comuna').val(data.comuna);
            $('#telefono').val(data.telefono);
            $('#prevision').val(data.prevision);
            $('#afp').val(data.afp);
            $('#fecha_ingreso').val(data.fecha_ingreso);
            $('#faena_termino').val(data.faena_termino);
            $('#sueldo_liquido').val(data.sueldo_liquido);
            $('#calzado').val(data.calzado);
            $('#cargo').val(data.cargo);
            $('#obra_fk').val(data.obra_fk);
            $('#estado').val(data.estado);
            $('#btn-save').val("update");
            $('#myModal').modal('show');

        })

    });

    //display modal form for creating new personal
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmpersonal').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete personal and remove it from list
    $('#personal-list').on('click', '.delete-personal',function(){
        var personal_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + personal_id,
            success: function (data) {
                console.log(data);

                $("#personal" + personal_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new personal / update existing personal
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {
       nombre: $('#nombre').val(),
       apellidos: $('#apellidos').val(),
       rut: $('#rut').val(),
       nacionalidad: $('#nacionalidad').val(),
       estado_civil: $('#estado_civil').val(),
       fecha_nac: $('#fecha_nac').val(),
       direccion: $('#direccion').val(),
       comuna: $('#comuna').val(),
       telefono: $('#telefono').val(),
       prevision: $('#prevision').val(),
       afp: $('#afp').val(),
       fecha_ingreso: $('#fecha_ingreso').val(),
       faena_termino: $('#faena_termino').val(),
       sueldo_liquido: $('#sueldo_liquido').val(),
       calzado: $('#calzado').val(),
       cargo: $('#cargo').val(),
       obra_fk: $('#obra_fk').val(),
       estado: $('#estado').val()

        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var personal_id = $('#personal_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + personal_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var personal = '<tr id="personal' + data.id + '"><td>' + data.id + '</td><td>' + data.nombre + '</td><td>' + data.apellidos + '</td><td>' + data.rut + '</td>'+ data.nacionalidad + '</td><td>'+ data.estado_civil + '</td><td>'+ data.fecha_nac + '</td><td>'+ data.direccion + '</td><td>'+ data.comuna + '</td><td>'+ data.telefono + '</td><td>'+ data.prevision + '</td><td>'+ data.afp + '</td><td>'+ data.fecha_ingreso + '</td><td>'+ data.faena_termino + '</td><td>' + data.sueldo_liquido + '</td><td>'+ data.calzado + '</td><td>'+ data.cargo + '</td><td>'+ data.obra_fk + '</<td><td>'+ data.estado +'</td></td>';
                personal += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Editar</button>';
                personal += '<button class="btn btn-danger btn-xs btn-delete delete-personal" value="' + data.id + '">Eliminar</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#personal-list').append(personal);
                }else{ //if user updated an existing record

                    $("#personal" + personal_id).replaceWith( personal );
                }

                $('#frmpersonal').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
