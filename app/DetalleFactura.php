<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table='detalle_factura';

    protected $fillable= ['id', 'cantidad', 'precio_unitario', 'total', 'factura_fk','nombrepu','user_fk','item_id'];



    public function nombrepu()
    {
        return $this->belongsTo('App\NombrePU','nombrepu');
    }

    public function factura()
    {
        return $this->belongsTo('App\Factura');
    }
}
