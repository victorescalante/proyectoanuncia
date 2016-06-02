<?php

use Illuminate\Database\Seeder;


class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name' => 'México',
        ]);

        DB::table('states')->insert([
            'name' => 'Distrito Federal',
            'created_at' => Carbon\Carbon::now(),
        ]);
    }
}
