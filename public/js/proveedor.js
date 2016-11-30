$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    }

})
$(document).ready(function(){

    var url = "proveedor";

    //display modal form for proveedor editing

    $('#proveedor-list').on('click', '.open-modal',function(){
        var proveedor_id = $(this).val();

        $.get(url + '/' + proveedor_id, function (data) {
            //success data
            console.log(data);
            $('#proveedor_id').val(data.id);
            $('#rut').val(data.rut);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#direccion').val(data.direccion);
            $('#btn-save').val("update");
            $('#myModal').modal('show');


        })

    });

    //display modal form for creating new proveedor
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmproveedor').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete proveedor and remove it from list
    $('#proveedor-list').on('click', '.delete-proveedor',function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        var proveedor_id = $(this).val();

        event.preventDefault();
        swal({
                title: "Estas seguro?",
                text: "Se eliminara permanentemente de la base de datos!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI, borrar!",
                cancelButtonText: "NO, cancelar!",
                closeOnConfirm: true,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal("Borrado!", "Fue borrado exitosamente.", "success");
                    $.ajax({

                        type: "DELETE",
                        url: url + '/' + proveedor_id,
                        success: function (data) {

                            console.log(data);

                            $("#proveedor" + proveedor_id).remove();
                            window.location.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                } else {
                    swal("Cancelado", "El texto no fue borrado :)", "error");
                }
            });
    });

    //create new proveedor / update existing proveedor
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {
            rut: $('#rut').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            direccion: $('#direccion').val()

        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var proveedor_id = $('#proveedor_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + proveedor_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var proveedor = '<tr id="proveedor' + data.id + '"><td>' + data.id + '</td><td>' + data.rut + '</td><td>' + data.name + '</td><td>' + data.email + '</td>'+ data.direccion + '</td><td>' ;
                proveedor += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Editar</button>';
                proveedor += '<button class="btn btn-danger btn-xs btn-delete delete-proveedor" value="' + data.id + '">Eliminar</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#proveedor-list').append(proveedor);
                }else{ //if user updated an existing record

                    $("#proveedor" + proveedor_id).replaceWith( proveedor );
                }

                $('#frmproveedor').trigger("reset");

                $('#myModal').modal('hide')
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
