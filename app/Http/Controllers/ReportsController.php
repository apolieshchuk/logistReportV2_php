<?php

namespace App\Http\Controllers;

use App\Cargos;
use App\Carriers;
use App\Contacts;
use App\Reports;
use App\Routes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportsController extends Controller
{
    public function index() {
        return view('report');
    }

    public function store (Request $request) {
        $json = $request->json()->all();

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

        // insert data
        $createdReports = [];
        foreach ($json as $key => $report) {
            $item = Reports::firstOrCreate($report);
            $item = [
                'num' => $key + 1,
                'date' => $item['date'],
                'route' => Routes::find($item['route_id'])->name,
                'carrier' => Carriers::find($item['carrier_id'])->name,
                'auto_num' => $item['auto_num'],
                'trail_num' => $item['trail_num'],
                'tel' => Contacts::find($item['driver_id'])->tel,
                'license' => Contacts::find($item['driver_id'])->license,
            ];
            array_push($createdReports, $item);
        }

        // update route
        Routes::find($json[0]['route_id'])->touch();

        return json_encode($createdReports);
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
     * input ->
     * {
     *  amount: N
     *  object: Model
     *  subject: Model
     * }
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

}
