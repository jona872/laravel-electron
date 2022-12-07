<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Usuario extends Model
{
    protected $table = 'cliente_usuario';

    protected $fillable = [ 'cliente_id', 'user_id' ];

    protected $hidden = [];
    
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
