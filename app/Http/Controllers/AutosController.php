<?php

namespace App\Http\Controllers;

use App\Autos;
use App\Carriers;
use App\Contacts;
use App\Posts;
use App\Reports;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class AutosController extends Controller
{
    public function index() {
        return view('auto', [
            'carriers' => Carriers::orderBy('name', 'asc')->get()
        ]);
    }

    public function store() {
        try {
            // if need - create new carrier todo now in DB all code fields empty and here NULL
            $carrier_id = request('carrier_id');
            if (request('newCarrierName')) {
                $carrier = Carriers::firstOrCreate([
                    'name' => request('newCarrierName'),
                    'type' => request('newCarrierType'),
                    'code' => request('newCarrierCode')
                ]);
                $carrier_id = $carrier->id;
            }

            // check or create driver
            $driver = Contacts::firstOrCreate([
                'surname' => request('dr_surn'),
                'name' => request('dr_name'),
                'father' => request('dr_fath'),
                'post_id' => Posts::where('name', 'Водій')->first()->id,
                'tel' => request('tel'),
                'license' => request('license')
            ]);

            // create auto
            Autos::firstOrCreate([
                'carrier_id' => $carrier_id,
                'mark' => request('mark'),
                'auto_num' => request('auto_num'),
                'trail_num' => request('trail_num'),
                'driver_id' => $driver->id,
                'notes' => request('notes'),
            ]);
        } catch (\Exception $e) {
            back()->withErrors($e->getMessage());
        }
        return back();
    }

    public function dataLoad() {
        // DONT CHANGE OBJECT. USING IN JS
        $autos = Autos::with([
            'carrier:id,name',
            'driver:id,surname,name,father,tel,license'
        ])->get();

        return json_encode(['data' => $autos]);
    }

}
