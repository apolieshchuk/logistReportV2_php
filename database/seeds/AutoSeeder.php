<?php

use App\Autos;
use App\Carriers;
use App\Contacts;
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
            Autos::firstOrCreate(
                [
                    'carrier_id' => Carriers::where('name', $auto['name'])->first()->id,
                    'mark' => $auto['mark'],
                    'auto_num' => $auto['auto_num'],
                    'trail_num' => $auto['trail_num'],
                    'driver_id' => Contacts::where([
                        ['name','=', $auto['dr_name']],
                        ['surname','=', $auto['dr_surn']],
                        ['father','=', $auto['dr_fath']],
                    ])->first()->id
                ]
            );
        }
    }
}
