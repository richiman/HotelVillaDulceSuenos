<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "Clientes";
    public $timestamps = false;
    protected $fillable = [
        'id','nombre','correo','telefono','estado','vehiculo'
    ];
}
