<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMontoFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factura', function (Blueprint $table) {
            $table->float('monto_exento');
            $table->float('descuentos');
            $table->string('impuesto_especifico');
            $table->float('neto');
            $table->float('iva');
            $table->float('total_concepto');
            $table->string('observacion');


        });
        }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('factura', function (Blueprint $table) {
            $table->dropColumn('monto_exento');
            $table->dropColumn('descuentos');
            $table->dropColumn('impuesto_especifico');
            $table->dropColumn('neto');
            $table->dropColumn('iva');
            $table->dropColumn('total_concepto');
            $table->dropColumn('observacion');
        });
}
}