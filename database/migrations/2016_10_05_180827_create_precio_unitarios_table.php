<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecioUnitariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preciounitario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->integer('cantidad');
            $table->float('subtotal');
            $table->float('total');
            $table->integer('nombrepu'); //puede ser null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preciounitario');
    }
}
