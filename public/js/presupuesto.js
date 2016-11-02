$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    }

})

$(document).ready(function(){

    var url = "presupuesto";

    //display modal form for presupuesto editing

    $('#presupuesto-list').on('click', '.open-modal',function(){
        var presupuesto_id = $(this).val();

        $.get(url + '/' + presupuesto_id, function (data) {
            //success data
            console.log(data);
            $('#presupuesto_id').val(data.id);
            $('#nombrepresupuesto').val(data.nombrepresupuesto);


            $('#btn-save').val("update");
            $('#myModal').modal('show');

        })

    });

    //display modal form for creating new presupuesto
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmpresupuesto').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete presupuesto and remove it from list
    $('#presupuesto-list').on('click', '.delete-presupuesto',function(){
        var presupuesto_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + presupuesto_id,
            success: function (data) {
                console.log(data);

                $("#presupuesto" + presupuesto_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new presupuesto / update existing presupuesto
    $('#btn-save').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {

            nombrepresupuesto: $('#nombrepresupuesto').val()


        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var presupuesto_id = $('#presupuesto_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + presupuesto_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var presupuesto = '<tr id="presupuesto' + data.id + '"><td>' + data.id + '</td><td>' + data.nombrepresupuesto + '</td><td>';
                presupuesto += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Editar</button>';
                presupuesto += '<button class="btn btn-danger btn-xs btn-delete delete-presupuesto" value="' + data.id + '">Eliminar</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#presupuesto-list').append(presupuesto);
                }else{ //if user updated an existing record

                    $("#presupuesto" + presupuesto_id).replaceWith( presupuesto );
                }

                $('#frmpresupuesto').trigger("reset");

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
