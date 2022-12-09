<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibroCompra extends Model
{
    protected $fillable = [ 
        'fecha', 'pto_venta', 'codigo', 'tipo_comprobante', 'nombre',
        'cuit', 'condicion', 'neto', 'iva','iva_liquidado', 'iva_sobretasa', 
        'percepcion','iva_retencion', 'impuestos_internos', 
        'conceptos_no_gravados', 'compras_no_inscriptas', 'total', 'tipo_op'
    ];
    
    protected $hidden = [];
}
