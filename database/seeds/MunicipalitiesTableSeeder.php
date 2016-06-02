<?php

use Illuminate\Database\Seeder;

class MunicipalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipalities')->insert([
            'name' => 'Toluca',
            'state_id' => 1,
        ]);

        DB::table('municipalities')->insert([
            'name' => 'Metepec',
            'state_id' => 1,
            'created_at' => Carbon\Carbon::now(),
        ]);

        DB::table('municipalities')->insert([
            'name' => 'Del. Cuajimalpa',
            'state_id' => 2,
            'created_at' => Carbon\Carbon::now(),
        ]);
    }
}
