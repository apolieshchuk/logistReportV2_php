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
                'date' => 'required',
                'manager_id' => 'required',
                'cargo_id'=> 'required',
                'route_id'=> 'required',
                'carrier_id'=> 'required',
                'auto_num'=> 'required',
                'trail_num'=> 'required',
                'driver_id'=> 'required',
                'f2'=> 'required',
                'f1'=> 'required',
                'tr'=> 'required',
            ]);

            if ($validator->fails()) {
                abort(400, $validator->errors()->first());
            }
        }

        // insert data
        foreach ($json as $report) {
            Reports::firstOrCreate($report);
        }

        return json_encode(["status" => "ok"]);
    }

    public function dataLoad() {
        $from = request('report_from') ?? config('constants.report_from');
        $to = request('report_to') ?? config('constants.report_to');
        $reports = Reports::whereBetween('date', [$from, $to])->with([
            'manager:id,surname',
            'cargo:id,name',
            'route:id,name',
            'carrier:id,name',
            'driver:id,surname'
        ])->get();

        return json_encode(['data' => $reports]);
    }
}
