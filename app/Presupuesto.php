<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table ='presupuesto';

    protected $fillable= ['nombrepresupuesto'];

    public function nombrepu()
    {
        return $this->hasMany('App\NombrePU');
    }
}
