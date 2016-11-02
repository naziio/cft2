<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NombrePU extends Model
{
    protected $table ='nombrepu';

    protected $fillable= ['id','nombrepu','unidad', 'presupuesto_fk'];

    public function preciounitario()
    {
        return $this->hasMany('App\PrecioUnitario');
    }
    public function presupuesto()
    {
        return $this->belongsto('App\Presupuesto');
    }
}
