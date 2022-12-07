<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [ 'name', 'cuit', 'condition', 'direction', 'activity_start', 'gross_receipts_tax' ];

    protected $hidden = [];
    
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
