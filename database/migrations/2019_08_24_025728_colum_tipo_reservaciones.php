<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumTipoReservaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Reservaciones',function (Blueprint $table){
            $table->string('tipo');
        });
        Schema::table('resp_reservas',function (Blueprint $table){
            $table->string('tipo');
        });

        Schema::table('resp_reservas',function (Blueprint $table){
            $table->string('folio');
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
            $table->dropColumn('tipo');
        });

        Schema::table('resp_reservas',function (Blueprint $table){
            $table->dropColumn('tipo');
        });

        Schema::table('resp_reservas',function (Blueprint $table){
            $table->dropColumn('folio');
        });
    }
}
