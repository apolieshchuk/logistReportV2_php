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
        $validator = \Validator::make(request()->input(), [
           'amount' => 'required|numeric',
            'object' => 'required|in:route',
            'value_id' => 'required|numeric',
            'subject' => 'required|in:cargo,manager,f2,f1,tr'
        ]);

        if ($validator->fails()) {
            abort(400, $validator->errors()->first());
        }

        // get vars from request
        $amount = request('amount');
        $value_id = request('value_id');
        $object = $this->parseModel(request('object'));
        $subject = $this->parseModel(request('subject'));

        // get most frequency id of subject
        $frequency_id = Reports::where($object, $value_id)
            ->latest()
            ->pluck($subject)
//            ->select($subject)
            ->take($amount)
            ->groupBy($subject)
//            ->orderByRaw('COUNT(*) DESC');
//            ->limit(1)
//            ->get()
            ->flatten()
            ->countBy()
            ->toArray()
//        $frequency_id = Reports::select($subject)->where($object, $value_id)
//            ->take($amount)->get()->toArray();
        ;
        asort($frequency_id);
//        print_r($frequency_id);
        return array_key_last($frequency_id);
    }

    private function parseModel(string $modelName) {
        // get Model
        switch ($modelName) {
            case 'route':
                return 'route_id';
                break;
            case 'cargo':
                return 'cargo_id';
                break;
            case 'manager':
                return 'manager_id';
                break;
            case 'f2':
                return 'f2';
                break;
            case 'f1':
                return 'f1';
                break;
            case 'tr':
                return 'tr';
                break;
            default:
                return null;
        }
    }
}
