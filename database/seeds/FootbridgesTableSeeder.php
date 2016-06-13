<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FootbridgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i=1;$i<=4;$i++){
            DB::table('footbridges')->insert([
                'name' => 'Puente '.$faker->firstName,
                'availability' => 'Disponible',
                'description' => $faker->paragraph,
                'municipality_id' => 1,
                'created_at' => Carbon\Carbon::now(),
            ]);
        }
    }
}
