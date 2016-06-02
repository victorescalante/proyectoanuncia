<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Victor Escalante',
            'email' => 'victorlt.xd3@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
