<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table= 'obra';

    protected $fillable = ['name','direccion','telefono', 'fecha'];
}
