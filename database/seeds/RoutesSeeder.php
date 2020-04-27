<?php

use App\Routes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes_old = DB::table('routes_old')->get();

        foreach ($routes_old as $route) {
            // add new
            Routes::firstOrCreate(['name' => $route->route]);
        }
    }
}
