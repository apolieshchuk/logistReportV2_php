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
        $this->call(CarrierSeeder::class);
        $this->call(RoutesSeeder::class);
        $this->call(AutoSeeder::class);
    }
}
