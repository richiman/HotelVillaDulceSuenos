<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activacion')->insert([
            "clave"=>'@P7!C4C!0N'
        ]);
    }
}
