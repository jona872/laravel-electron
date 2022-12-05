<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [ 'code', 'type', 'sender_id', 'receiver_id', 'iva', 'subtotal', 'total' ];

    protected $hidden = [];
    
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
