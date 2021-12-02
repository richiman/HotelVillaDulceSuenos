<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prereserva extends Model
{
    protected $table = "prereservas";
    public $timestamps = false;
    protected $fillable = [
        'id','fecha','count'
    ];
}
