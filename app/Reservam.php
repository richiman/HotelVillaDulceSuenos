<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservam extends Model
{
    protected $table = "reservasm";
    public $timestamps = false;
    protected $fillable = [
        'id','fecha','count'
    ];
}
