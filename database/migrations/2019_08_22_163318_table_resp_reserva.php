<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRespReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resp_reservas',function (Blueprint $table){
            $table->increments("id");
            $table->integer('idEmpleado');
            $table->integer('idCliente');
            $table->integer('idHabitacion');
            $table->date('fechallegada');
            $table->date('fechasalida');
            $table->integer('adultos');
            $table->integer('ninos');
            $table->integer('status');
            $table->date('created_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resp_reservas');
    }
}
