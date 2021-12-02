<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumConfirmarYComentarioReservaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Reservaciones',function (Blueprint $table){
            $table->boolean('confirmado');
            $table->longText('comentario');
        });
        Schema::table('resp_reservas',function (Blueprint $table){
            $table->boolean('confirmado');
            $table->longText('comentario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Reservaciones',function (Blueprint $table){
            $table->dropColumn('confirmado');
            $table->dropColumn('comentario');
        });

        Schema::table('resp_reservas',function (Blueprint $table){
            $table->dropColumn('confirmado');
            $table->dropColumn('comentario');
        });
    }
}
