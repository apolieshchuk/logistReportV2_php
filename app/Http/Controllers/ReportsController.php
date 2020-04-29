<?php

namespace App\Http\Controllers;

use App\Reports;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportsController extends Controller
{
    public function index() {
        $from = request('start-date') ?? config('constants.report_from');
        $to = request('end-date') ?? config('constants.report_to');
//        dd(request()->input());
        return view('report', [
            'reports' => Reports::whereBetween('date', [$from, $to])->get(),
        ]);
    }

    // for dataTables serverside render
//    public function dataLoad() {
//        $reports = Reports::all();
//        return  DataTables::of($reports)->make(true);
//    }
    public function dataLoad() {
        $from = request('start-date') ?? config('constants.report_from');
        $to = request('end-date') ?? config('constants.report_to');
        $reports = Reports::whereBetween('date', [$from, $to])->get();

//        dd($reports);
        // pack data to tables column format
        $data = [];
        foreach ($reports as $report) {
            $item = [];
            array_push($item, ""); //checkbox
            array_push($item, $report->date);
            array_push($item, $report->manager->surname);
            array_push($item, $report->cargo->name);
            array_push($item, $report->route->name);
            array_push($item, $report->carrier->name);
            array_push($item, $report->auto_num);
            array_push($item, $report->trail_num);
            array_push($item, $report->driver->surname);
            array_push($item, $report->f2);
            array_push($item, $report->f1);
            array_push($item, $report->tr);
            array_push($item, $report->notes);
            array_push($item, $report->id);

            array_push($data, $item);
        }
//
//
//        // convert to table format { 'data': [[1,2,3],[1,2,3]]}
//        $data = $data->map(function($obj){
//            return array_values($obj->toArray());
//        });

        return json_encode(['data' => $data]);
    }
}
