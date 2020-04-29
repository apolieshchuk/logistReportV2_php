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
        $this->call(RoutesSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(ContactsSeeder::class); // TODO REMOVE TRY
        $this->call(CarrierSeeder::class);
        $this->call(AutoSeeder::class);
        $this->call(ReportSeeder::class); // TODO REMOVE TRY
    }
}
