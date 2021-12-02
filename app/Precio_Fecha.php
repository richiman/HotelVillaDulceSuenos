<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Precio_Fecha extends Model
{
    protected $table = "precios_fecha";
    public $timestamps = false;
    protected $fillable = [
        'id','idHabitacion','de','a','costo'
    ];
}
