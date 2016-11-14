<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NombrePU extends Model
{
    protected $table ='nombrepu';

    protected $fillable= ['id','nombrepu','unidad','cantidad','preciounitario','total', 'presupuesto_fk','id_producto'];

    public function preciounitario()
    {
        return $this->hasMany('App\PrecioUnitario');
    }
    public function presupuesto()
    {
        return $this->belongsto('App\Presupuesto');
    }
    public function detalle()
    {
        return $this->hasmany('App\DetalleFactura', 'nombrepu');
    }
}
