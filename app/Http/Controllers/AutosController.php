<?php

namespace App\Http\Controllers;

use App\Autos;
use App\Reports;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class AutosController extends Controller
{
    public function index() {
        return view('auto');
    }

    public function dataLoad() {
        $autos = Autos::with([
            'carrier:id,name',
            'driver:id,surname,name,father,tel,license'
        ])->get();

        return json_encode(['data' => $autos]);
    }

}
