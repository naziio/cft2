<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioUnitario extends Model
{
    protected $table ='preciounitario';

    protected $fillable= ['item','cantidad','subtotal','total'];


    public function nombrepu()
    {
        return $this->belongsTo('App\NombrePU');
    }
}
