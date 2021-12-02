<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model
{
    protected $table = "hospedaje";
    public $timestamps = false;
    protected $fillable = [
        'id','Nombre','Apellido','correo','creado','creadopor',
        'fechallegada','fechasalida','telefono','habitacion'
    ];
}
