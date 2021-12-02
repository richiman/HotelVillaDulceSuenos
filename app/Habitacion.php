<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = "Habitaciones";
    public $timestamps = false;
    protected $fillable = [
        'id','numero','capacidad',"tipo",'c1','c2','c3','c4','c5','c6','pa'
    ];

    public function precios() {
        return $this->hasMany(Precio_Fecha::class,  'idHabitacion', 'id');
    }
}
