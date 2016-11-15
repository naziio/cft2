var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: "../php/staff.php",
        table: "#comparar",
        fields: [ {
            label: "Item:",
            name: "nombrepu"
        }, {
            label: "Cantidad:",
            name: "cantidad"
        }, {
            label: "Precio Unitario:",
            name: "precio_unitario"
        }, {
            label: "Total:",
            name: "total"
        }
        ]
    } );

    var table = $('#comparar').DataTable( {
        lengthChange: false,
        ajax: "../php/staff.php",
        columns: [
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                return data.nombrepu;
            } },
            { data: "cantidad" },
            { data: "precio_unitario" },
            { data: "total", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
        ],
        select: true
    } );

    //Display the buttons
    new $.fn.dataTable.Buttons( table, [
        { extend: "create", editor: editor },
        { extend: "edit",   editor: editor },
        { extend: "remove", editor: editor }
    ] );

    table.buttons().container()
        .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
} );/**
 * Created by CONSTRUCTORA CFT on 15-11-16.
 */
