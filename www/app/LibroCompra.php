<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibroCompra extends Model
{
    //sender_id = datos del cliente
    //receiver_id = datos del usuario
    //solamente me quedo con el sender_id, los demas datos del cliente los saco de la bd
    protected $fillable = [ 
        'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante', 
        'receiver_id', 'sender_id',
        'neto', 'iva','iva_liquidado', 'iva_sobretasa', 'percepcion','iva_retencion', 
        'impuestos_internos', 'conceptos_no_gravados', 'compras_no_inscriptas', 'total', 'tipo_op', 'tipo_calculo'
    ];
    
    protected $hidden = [];
}
