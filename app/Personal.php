<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table='personals';

    protected $fillable=['nombre', 'apellidos', 'rut' ,'nacionalidad', 'estado_civil','fecha_nac','direccion', 'comuna',
    'telefono', 'prevision', 'afp', 'fecha_ingreso', 'faena_termino', 'sueldo_liquido', 'calzado', 'cargo'];
}
