$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    }

})

$(document).ready(function(){

    var url = "http://admin.constructoracft.cl/obra/factura";
    //display modal form for factura editing

    $('#factura-list').on('click', '.open-modal',function(){
        var factura_id = $(this).val();
        $.get('http://admin.constructoracft.cl/obra/factura/' + factura_id+ '/edit',function(data){
            console.log(data);
            $('#factura_id').val(data.id);
            $('#razon_social').val(data.razon_social);
            $('#recargo').val(data.recargo);
            $('#num_factura').val(data.num_factura);
            $('#monto_exento').val(data.monto_exento);
           // $('#descuentos').val(data.descuentos);
            $('#impuesto_especifico').val(data.impuesto_especifico);
         /*   $('#neto').val(data.neto);
            $('#iva').val(data.iva);
            $('#subtotal').val(data.subtotal);
           // $('#total_concepto').val(data.total_concepto);
           // $('#observacion').val(data.observacion);
          */  $('#obra_fk').val(data.obra_fk);
            // $('#estado').val(data.estado);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        });

    });

    //display modal form for creating new factura
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmfactura').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete factura and remove it from list
    $('#factura-list').on('click', '.delete-factura',function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        var factura_id = $(this).val();
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
                        url: url + '/' + factura_id,
                        success: function (data) {

                            console.log(data);

                            $("#factura" + factura_id).remove();
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

    //create new factura / update existing factura
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault();

        var formData = {
            razon_social: $('#razon_social').val(),
            recargo: $('#recargo').val(),
            num_factura: $('#num_factura').val(),
            monto_exento: $('#monto_exento').val(),
            impuesto_especifico: $('#impuesto_especifico').val(),
          /*  descuentos: $('#descuentos').val(),

            neto: $('#neto').val(),
            iva:  $('#iva').val(),
            subtotal: $('#subtotal').val(),
          //  total_concepto: $('#total_concepto').val(),
           observacion: $('#observacion').val(),
           */  obra_fk:  $('#obra_fk').val()
           // estado: $('#estado').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var factura_id = $('#factura_id').val();
       var obra_fk=  $('#obra_fk').val();
       // var my_url = url + '/' + factura_id;
        var my_url = url + '/' + obra_fk;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
           var my_url = url += '/' + factura_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var factura = '<tr id="factura' + data.id + '"><td>' + data.id + '</td><td>' + data.razon_social + '</td><td>'+ data.recargo + '</td><td>' + data.num_factura +  '</td><td>' + data.monto_exento + '</td><td>' + data.impuesto_especifico + '</td><td>'+ data.obra_fk + '</td>';
                factura += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                factura += '<button class="btn btn-danger btn-xs btn-delete delete-factura" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#factura-list').append(factura);
                }else{ //if user updated an existing record

                    $("#factura" + factura_id).replaceWith( factura );
                }

                $('#frmfactura').trigger("reset");

                $('#myModal').modal('hide')
                window.location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});