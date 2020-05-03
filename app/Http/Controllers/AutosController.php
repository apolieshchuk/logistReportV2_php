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

    public function show($id) {
        return Autos::with([
            'driver:id,surname,name,father,tel,license'
        ])->find($id);
    }

    public function store() {
        try {
            $validator = $this->checkValid(request()->input());

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            // if need - create new carrier or return exists
            $carrier_id = $this->findOrCreateCarrier();

            // check or create driver
            $driver_id = $this->findOrCreateDriver();

            // create auto
            Autos::firstOrCreate([
                'carrier_id' => $carrier_id,
                'mark' => request('mark'),
                'auto_num' => request('auto_num'),
                'trail_num' => request('trail_num'),
                'driver_id' => $driver_id,
                'notes' => request('notes'),
            ]);
        } catch (\Exception $e) {
            return back()
                ->withErrors($e->getMessage())
                ->with('modal','update');
        }
        return back();
    }

    public function update(Autos $auto) {
        try {
            $validator = $this->checkValid(request()->input());

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            // if need - create new carrier or return exists
            $carrier_id = $this->findOrCreateCarrier();

            // check or create driver
            $driver_id = $this->findOrCreateDriver();

            $auto->update([
                'carrier_id' => $carrier_id,
                'mark' => request('mark'),
                'auto_num' => request('auto_num'),
                'trail_num' => request('trail_num'),
                'driver_id' => $driver_id,
                'notes' => request('notes'),
            ]);

            // update
            $auto->touch();

            return back();

        } catch (\Exception $e) {
            return back()
                ->withErrors($e->getMessage())
                ->with('modal','update')
                ->with('id', $auto->id);
//            abort(500, "Some problems in updating");
        }

//        return request()->input();
    }

    /**
     *  This function find exists carrier_id or create new carrier
     */
    private function findOrCreateCarrier () {
        // if need - create new carrier todo now in DB all code fields empty and here NULL
        $carrier_id = request('carrier_id');

        // carrier type
        $carrier_type = "";
        if (request('newCarrierType')) {
            $carrier_type = " ".request('newCarrierType');
        }

        // if need create new carrier
        if (request('newCarrierName')) {
            $carrier = Carriers::firstOrCreate([
                'name' => request('newCarrierName').$carrier_type, // todo tmp later remove type
//                'type' => request('newCarrierType'), todo for future updates
//                'code' => request('newCarrierCode')
            ]);
            $carrier_id = $carrier->id;
        }
        return $carrier_id;
    }

    /**
     *  This function find exists driver_id or create new driver
     */
    private function findOrCreateDriver () {
        // check or create driver
        $driver = Contacts::firstOrCreate([
            'surname' => request('dr_surn'),
            'name' => request('dr_name'),
            'father' => request('dr_fath'),
            'post_id' => Posts::where('name', 'Водій')->first()->id,
            'tel' => request('tel'),
        ], ['license' => request('license')]); // todo don't check license for compare

        // if creating or updating with license - update old license
        if (request('license')) {
            $driver->license = request('license');
            $driver->save();
        }
        return $driver->id;
    }

    public function dataLoad() {
        // DONT CHANGE OBJECT. USING IN JS
        $autos = Autos::with([
            'carrier:id,name',
            'driver:id,surname,name,father,tel,license'
        ])->get();

        return json_encode(['data' => $autos]);
    }

    private function checkValid($request) {
        return \Validator::make($request, [
           'dr_surn' => 'required_without:dr_name'
        ]);
    }

}
