<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = "Reservaciones";
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;
    protected $fillable = [
        "id",'idEmpleado','idCliente','idHabitacion','fechallegada','fechasalida','adultos','ninos','status',
        'created_at','folio','tipo','confirmado','comentario','price'
    ];

    public function habitacion() {
        return $this->hasOne(Habitacion::class,  'id', 'idHabitacion');
    }

    public function cliente() {
        return $this->hasOne(Cliente::class,  'id', 'idCliente');
    }
}
