<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableReservacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reservaciones',function (Blueprint $table){
           $table->increments("id");
           $table->integer('idEmpleado')->unsigned();
           $table->integer('idCliente')->unsigned();
           $table->integer('idHabitacion')->unsigned();
           $table->date('fechallegada');
           $table->date('fechasalida');
           $table->integer('adultos');
           $table->integer('ninos');
           $table->integer('status');
           $table->date('created_at');

           $table->foreign('idEmpleado')->references('id')->on('Empleados');
           $table->foreign('idCliente')->references('id')->on('Clientes');
           $table->foreign('idHabitacion')->references('id')->on('Habitaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Reservaciones');
    }
}
