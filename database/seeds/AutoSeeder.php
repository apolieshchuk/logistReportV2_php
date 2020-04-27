<?php

use App\Auto;
use App\Carrier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autos = DB::table('auto_old')->get();

        foreach ($autos as $auto) {
            $auto = get_object_vars($auto);
            Auto::firstOrCreate(
                [
                    'carrier_id' => Carrier::where('name', $auto['name'])->first()->id,
                    'mark' => $auto['mark'],
                    'auto_num' => $auto['auto_num'],
                    'trail_num' => $auto['trail_num'],
                    'dr_surn' => $auto['dr_surn'],
                    'dr_name' => $auto['dr_name'],
                    'dr_fath' => $auto['dr_fath'],
                    'tel'=> $auto['tel'],
                    'notes'=> $auto['notes'],
                ]
            );
        }
    }
}
