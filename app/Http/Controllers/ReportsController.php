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
//        return request('data');
        $arrOfResults = [];
        foreach (request('data') as $ratioObject) {
            array_push($arrOfResults, $this->calcRatio($ratioObject));
        }

        return json_encode(['data' => $arrOfResults]);

    }

    private function calcRatio($ratioObject) {

        // validate object
        if(!$this->validateRatio($ratioObject)) {
            return null;
        }

        // get vars from object
        $amount = $ratioObject['amount'];
        $value_id = $ratioObject['value_id'];
        $object = $this->parseModel($ratioObject['object']);
        $subject = $this->parseModel($ratioObject['subject']);
        $moreObjects = $ratioObject['moreObjects'] ?? null;

        // add more objects for "where- filter"
        $startWhere = Reports::where($object, $value_id);

        if($moreObjects) {
            foreach ($moreObjects as $obj) {
                $objName = $this->parseModel($obj['object']);
                $startWhere = $startWhere->where($objName, $obj['value']);
            }

            // check if carrier don't have enough races in route
            if ($startWhere->count() < $amount/2) {
                $startWhere = Reports::where($object, $value_id);
            }
        }

        // get most frequency id of subject
        $frequency_id = $startWhere
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
        return array_key_last($frequency_id) ?? 0;
    }

    private function validateRatio($ratioObject) {

        $validator = \Validator::make($ratioObject, [
            'amount' => 'required|numeric',
            'object' => 'required|in:route, carrier',
            'value_id' => 'required|numeric',
            'subject' => 'required|in:cargo,manager,f2,f1,tr'
        ]);

        if ($validator->fails()) {
            return false;
//            abort(400, $validator->errors()->first());
        }
        return true;
    }

    private function parseModel(string $modelName) {
        // get Model
        switch ($modelName) {
            case 'route':
                return 'route_id';
                break;
            case 'carrier':
                return 'carrier_id';
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
