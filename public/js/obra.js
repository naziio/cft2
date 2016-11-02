$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    }

})

$(document).ready(function(){

    var url = "obra";

    //display modal form for obra editing

    $('#obra-list').on('click', '.open-modal',function(){
        var obra_id = $(this).val();

        $.get(url + '/' + obra_id, function (data) {
            //success data
            console.log(data);
            $('#obra_id').val(data.id);
            $('#name').val(data.name);
            $('#direccion').val(data.direccion);
            $('#telefono').val(data.telefono);
            $('#fecha').val(data.fecha);
            $('#btn-save').val("update");
            $('#myModal').modal('show');

        })

    });

    //display modal form for creating new obra
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmobra').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete obra and remove it from list
    $('#obra-list').on('click', '.delete-obra',function(){
        var obra_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + obra_id,
            success: function (data) {
                console.log(data);

                $("#obra" + obra_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new obra / update existing obra
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {

            name: $('#name').val(),
            direccion: $('#direccion').val(),
            telefono: $('#telefono').val(),
            fecha: $('#fecha').val()

        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var obra_id = $('#obra_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + obra_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var obra = '<tr id="obra' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.direccion + '</td><td>' + data.telefono + '</td><td>'+ data.fecha + '</td><td>' ;
                obra += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Editar</button>';
                obra += '<button class="btn btn-danger btn-xs btn-delete delete-obra" value="' + data.id + '">Eliminar</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#obra-list').append(obra);
                }else{ //if user updated an existing record

                    $("#obra" + obra_id).replaceWith( obra );
                }

                $('#frmobra').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
/**
 * Created by CONSTRUCTORA CFT on 29-09-16.
 */
