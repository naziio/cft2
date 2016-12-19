<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{

    protected $table='factura';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','razon_social','recargo','obra_fk',
        'num_factura', 'monto_exento','impuesto_especifico','user_fk'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function detalle()
    {
        return $this->hasMany('App\DetalleFactura','factura_fk', 'id');
    }

}
