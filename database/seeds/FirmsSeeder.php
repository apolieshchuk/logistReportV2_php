<?php

use App\Firms;
use Illuminate\Database\Seeder;

class FirmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Firms::class,10)->create();
    }
}
