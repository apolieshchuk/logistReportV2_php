<?php

use App\Carrier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrierSeeder extends Seeder
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

            //validate dupliactes
            $validator = \Validator::make($auto,[
                'name' => "required|unique:carriers",
            ]);

            if($validator->fails()) continue;

            // add new
            Carrier::create(
                [
                    'name' => $auto['name'],
                    'code' => $auto['code'],
                ]
            );
        }
    }
}
