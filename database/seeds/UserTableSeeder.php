<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
