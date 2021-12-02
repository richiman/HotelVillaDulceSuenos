<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPreciosFecha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios_fecha',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idHabitacion')->unsigned();
            $table->date('de');
            $table->date('a');
            $table->integer('costo');

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
        Schema::dropIfExists('precios_fecha');
    }
}
