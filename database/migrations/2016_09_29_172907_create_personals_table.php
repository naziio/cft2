<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->char('rut')->unique();
            $table->string('nacionalidad');
            $table->string('estado_civil')->nullable();
            $table->date('fecha_nac');
            $table->char('direccion');
            $table->string('comuna')->nullable();
            $table->string('telefono');
            $table->string('prevision')->nullable();
            $table->string('afp')->nullable();
            $table->date('fecha_ingreso');
            $table->string('faena_termino')->nullable();
            $table->float('sueldo_liquido');
            $table->float('calzado')->nullable();
            $table->string('cargo');
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
        Schema::dropIfExists('personals');
    }
}
