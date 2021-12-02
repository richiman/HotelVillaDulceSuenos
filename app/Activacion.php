<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activacion extends Model
{
    protected $table = "activacion";
    public $timestamps = false;
    protected $fillable = [
        'id','clave'
    ];
}
