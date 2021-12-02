<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("Empleados",function (Blueprint $table){
           $table->increments('id');
           $table->string('nombre');
           $table->string('user');
           $table->string('password');
           $table->integer('tipo');
           $table->string('fincion');
           $table->string('telefono');
           $table->string('correo');
           $table->date("creado");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Empleados');
    }
}
