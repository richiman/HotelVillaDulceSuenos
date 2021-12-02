<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospedajem extends Model
{
    protected $table = "hospedajesm";
    public $timestamps = false;
    protected $fillable = [
        'id','fecha','count'
    ];
}
