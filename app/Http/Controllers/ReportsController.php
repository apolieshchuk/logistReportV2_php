<?php

namespace App\Http\Controllers;

use App\Autos;
use App\Cargos;
use App\Carriers;
use App\Contacts;
use App\Posts;
use App\Reports;
use App\Routes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportsController extends Controller
{
    public function index() {
        $managers = Contacts::orderBy('updated_at', 'desc')
            ->where('post_id', Posts::where('name', 'Менеджер')
            ->first()->id)->get();
        $drivers = Contacts::orderBy('surname', 'asc')
            ->where('post_id', Posts::where('name', 'Водій')
            ->first()->id)->get();

        return view('report', [
            'routes' => Routes::orderBy('updated_at', 'desc')->orderBy('name', 'asc')->get(),
            'cargos' => Cargos::orderBy('updated_at', 'desc')->orderBy('name', 'asc')->get(),
            'managers' => $managers,
            'carriers' => Carriers::orderBy('name', 'asc')->get(),
            'drivers' => $drivers
        ]);
    }

    public function store (Request $request) {
        $json = $request->json()->all();

        $createdReports = []; // report for clipboard
        foreach ($json as $item) {
            $validator = \Validator::make($item, [
                'date' => 'required|date',
                'manager_id' => 'required|numeric',
                'cargo_id'=> 'required|numeric',
                'route_id'=> 'required|numeric',
                'carrier_id'=> 'required|numeric',
                'auto_num'=> 'required',
                'trail_num'=> 'required',
                'driver_id'=> 'required|numeric',
                'f2'=> 'required|numeric',
                'f1'=> 'required|numeric',
                'tr'=> 'required',
            ]);

            if ($validator->fails()) {
                abort(400, $validator->errors()->first());
            }
        }

        foreach ($json as $key => $report) {
            $item = Reports::firstOrCreate($report); // insert data

            // create items for copy in clipboard
            $item = [
                'num' => $key + 1,
                'date' => $item['date'],
                'route' => Routes::find($item['route_id'])->name,
                'carrier' => Carriers::find($item['carrier_id'])->name,
                'auto_num' => $item['auto_num'],
                'trail_num' => $item['trail_num'],
                'dr_surn' => Contacts::find($item['driver_id'])->surname,
                'dr_name' => Contacts::find($item['driver_id'])->name,
                'dr_fath' => Contacts::find($item['driver_id'])->father,
                'tel' => Contacts::find($item['driver_id'])->tel,
                'license' => Contacts::find($item['driver_id'])->license,
            ];
            array_push($createdReports, $item);
        }

        // update route history
        Routes::find($json[0]['route_id'])->touch();
        // update cargo history
        Cargos::find($json[0]['cargo_id'])->touch();
        // update manager history
        Contacts::find($json[0]['manager_id'])->touch();

        return json_encode($createdReports);
    }

    public function destroy(Reports $report) {
        $report->delete();
        return back();
    }

    public function show(Reports $report) {
        return $report;
    }

    public function update(Reports $report) {

        try {
            $validator = $this->checkValid(request()->input());

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            // if need - create new carrier or return exists
//            $carrier_id = $this->findOrCreateCarrier();

            // check or create driver
//            $driver_id = $this->findOrCreateDriver();

            $report->update([
                'date' => request('date'),
                'manager_id' => request('manager_id'),
                'cargo_id' => request('cargo_id'),
                'route_id' => request('route_id'),
                'carrier_id' => request('carrier_id'),
                'auto_num' => request('auto_num'),
                'trail_num' => request('trail_num'),
                'driver_id' => request('driver_id'),
                'f2' => request('f2'),
                'f1' => request('f1'),
                'tr' => request('tr'),
                'notes' => request('notes'),
            ]);

            // update
            $report->touch();

            return back();

        } catch (\Exception $e) {
            return back()
                ->withErrors($e->getMessage())
                ->with('id', $report->id);
        }
    }

    public function dataLoad() {
        $from = request('report_from') ?? config('constants.report_from');
        $to = request('report_to') ?? config('constants.report_to');
        $reports = Reports::whereBetween('date', [$from, $to])
            ->latest()
            ->with([
            'manager:id,surname',
            'cargo:id,name',
            'route:id,name',
            'carrier:id,name',
            'driver:id,surname'
        ])->get();

        return json_encode(['data' => $reports]);
    }

    /**
     * Get ratio one model to another
     *
     *
     */
    public function ratio() {
        $amount = request('amount');
        $route_id = request('route_id');
        $subject = request('subject');
        $subject_id = request('subject_id');

        $result = Reports::where('route_id', $route_id);
        if($subject) {
            $result = $result->where($subject."_id", $subject_id);
            // check if carrier don't have enough races in route
            if ($result->count() < $amount/2) {
                $result = Reports::where('route_id', $route_id);
            }
        }
        $result = $result
            ->latest()
            ->take($amount)
            ->get();

        // most frequencies
        $f1 = $this->getMostFrequency($result, 'f1');
        $f2 = $this->getMostFrequency($result, 'f2');
        $tr = $this->getMostFrequency($result, 'tr');
        $cargo_id = $this->getMostFrequency($result, 'cargo_id');
        $manager_id = $this->getMostFrequency($result, 'manager_id');

        // return json
        return json_encode([
            'f1' => $f1,
            'f2' => $f2,
            'tr' => $tr,
            'cargo_id' => $cargo_id,
            'manager_id' => $manager_id
        ]);
    }

    private function getMostFrequency($collection, $column_name) {
        $arr = $collection->pluck($column_name)->countBy()->toArray();
        asort($arr);
        return array_key_last($arr);
    }

    private function checkValid($request) {
        return \Validator::make($request, [
            'f2' => 'numeric',
            'f1' => 'numeric',
            'tr' => 'in:0,1',
            'date' => 'required',
            'route_id' => 'required',
            'manager_id' => 'required',
            'cargo_id' => 'required',
            'carrier_id' => 'required',
            'auto_num' => 'required',
            'driver_id' => 'required',
//            'dr_surn' => 'required_without:dr_name'
        ]);
    }

}
