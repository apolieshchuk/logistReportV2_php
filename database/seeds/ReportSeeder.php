<?php

use App\Cargos;
use App\Carriers;
use App\Contacts;
use App\Managers;
use App\Reports;
use App\Routes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
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
            try { // TODO REMOVE TRY
                Reports::firstOrCreate([
                    'date' => $report->route_date,
                    'manager_id' => Contacts::where('surname', $report->manager)->first()->id,
                    'cargo_id' => Cargos::where('name', $report->crop)->first()->id,
                    'route_id' => Routes::where('name', $report->route)->first()->id,
                    'carrier_id' => Carriers::where('name', $report->carrier)->first()->id,
                    'auto_num' => $report->auto_num,
                    'driver_id' => Contacts::where('surname', $report->dr_surn)->first()->id,
                    'f2' => $report->f2,
                    'f1' => $report->f1,
                    'tr' => $report->tr === 'НІ'? 0 : 1,
                ]);
            } catch (Exception $e){
                continue;
            }
        }
    }
}
