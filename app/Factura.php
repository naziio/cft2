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
    protected $fillable = ['razon_social','subtotal','recargo','obra_fk',
        'num_factura', 'monto_exento', 'descuentos','impuesto_especifico', 'neto', 'iva', 'total_concepto','observacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function detalle()
    {
        return $this->belongsToMany('App\DetalleFactura','id_producto');
    }

}
