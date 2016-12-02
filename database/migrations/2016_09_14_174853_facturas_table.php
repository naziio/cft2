<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social');
           // $table->foreign('razon_social')->references('name')->on('proveedor')->onDelete('cascade');
           // $table->char('rut')->unique();
            $table->float('subtotal');
            $table->float('recargo');
            $table->integer('num_factura')->unique();
           // $table->integer('detalle_factura_fk')->unsigned();
           // $table->foreign('detalle_factura_fk')->references('id')->on('detalle_factura')->onDelete('cascade');
           // $table->integer('proveedor_fk')->unsigned();
           //$table->foreign('proveedor_fk')->references('id')->on('proveedor')->onDelete('cascade');
           // $table->float('total_venta');
          //  $table->enum('estado', ['pagado','pendiente']);
            $table->integer('obra_fk'); //nuevo
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
        Schema::drop('factura');
    }
}
