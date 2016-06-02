<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AdminsTableSeeder::class);
        $this->command->info('Admin table seeded!');

        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table seeded!');

        $this->call(StatesTableSeeder::class);
        $this->command->info('States table seeded!');

        $this->call(MunicipalitiesTableSeeder::class);
        $this->command->info('Municipalities table seeded!');

        $this->call(FootbridgesTableSeeder::class);
        $this->command->info('Footbridges table seeded!');

    }
}
