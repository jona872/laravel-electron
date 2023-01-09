<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibroVenta extends Model
{
    protected $fillable = [ 
        'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante',
        'receiver_id', 'sender_id',
        'neto', 'iva','iva_liquidado','iva_sobretasa',
        'percepcion','iva_retencion','conceptos_no_gravados',
        'ingresos_exentos','ganancias_retencion','total','tipo_op' , 'tipo_calculo'
    ];
    
    protected $hidden = [];
}
