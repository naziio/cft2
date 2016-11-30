$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    }

})

$(document).ready(function(){

    var url = "detalle";

    //display modal form for detalle editing

    $('#detalle-list').on('click', '.open-modal',function(){
        var detalle_id = $(this).val();

        $.get(url + '/' + detalle_id, function (data) {
            //success data
            console.log(data);
            $('#detalle_id').val(data.id);

            $('#id_producto').val(data.id_produco);
            $('#cantidad').val(data.cantidad);
            $('#precio_unitario').val(data.precio_unitario);
            $('#total').val(data.total);
           $('#factura_fk').val(data.factura_fk);
            $('#btn-save').val("update");
            $('#myModal').modal('show');

        })
    });

    //display modal form for creating new detalle
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmdetalle').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete detalle and remove it from list
    $('#detalle-list').on('click', '.delete-detalle',function(){
        var detalle_id = $(this).val();

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
                        url: url + '/' + detalle_id,
                        success: function (data) {

                            console.log(data);

                            $("#detalle" + detalle_id).remove();
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

    //create new detalle / update existing detalle
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {


            id_producto: $('#id_producto').val(),
            cantidad:  $('#cantidad').val(),
            precio_unitario: $('#precio_unitario').val(),
            total: $('#total').val(),
            factura_fk: $('#factura_fk').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var detalle_id = $('#detalle_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + detalle_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var detalle = '<tr id="detalle' + data.id + '"><td>' + data.id + '</td><td>' + data.id_producto + '</td><td>' + data.cantidad + '</td><td>' + data.precio_unitario + '</td><td>' + data.total + '</td><td>'+ data.factura_fk + '</td><td>';
                detalle += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                detalle += '<button class="btn btn-danger btn-xs btn-delete delete-detalle" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#detalle-list').append(detalle);
                }else{ //if user updated an existing record

                    $("#detalle" + detalle_id).replaceWith( detalle );
                }

                $('#frmdetalle').trigger("reset");

                $('#myModal').modal('hide')
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});