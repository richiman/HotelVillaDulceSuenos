<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnsPreciosHabitaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Habitaciones',function (Blueprint $table){
            $table->integer('c4');
            $table->integer('c5');
            $table->integer('c6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Habitaciones',function (Blueprint $table){
            $table->dropColumn('p4');
            $table->dropColumn('p5');
            $table->dropColumn('p6');
        });
    }
}
