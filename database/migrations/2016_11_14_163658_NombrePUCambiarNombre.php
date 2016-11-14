<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NombrePUCambiarNombre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_factura', function ($table) {
            $table->renameColumn('id_producto', 'nombrepu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

Schema::table('detalle_factura', function ($table) {
    $table->dropColumn('nombrepu');
});
    }
}
