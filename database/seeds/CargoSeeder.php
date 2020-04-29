<?php

use App\Cargos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = DB::table('reptable_old')->get();

        foreach ($reports as $report) {
            Cargos::firstOrCreate([
                'name' => $report->crop,
            ]);
        }
    }
}
