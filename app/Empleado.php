<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = "Empleados";
    public const CREATED_AT = 'creado';
    public const UPDATED_AT = null;
    protected $fillable = [
        'id','nombre','user','password','tipo','fincion','telefono','correo',"creado",
    ];

    public function reservacion()
    {
      return $this->hasMany(Reserva::class,  'idEmpleado');
    }
  
}
