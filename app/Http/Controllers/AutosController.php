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
        $autos = Autos::all();

        // cache
        $autosData = \Cache::get('autosData');
        // if we have cache
        if ($autosData) {
            return json_encode(['data' => $autosData]);
        }

        // pack data to tables column format
        $data = [];
        foreach ($autos as $auto) {
            $item = [];
            array_push($item, ""); //checkbox
            array_push($item, $auto->carrier->name);
            array_push($item, $auto->mark);
            array_push($item, $auto->auto_num);
            array_push($item, $auto->trail_num);
            array_push($item, $auto->driver->surname);
            array_push($item, $auto->driver->name);
            array_push($item, $auto->driver->father);
            array_push($item, $auto->driver->tel);
            array_push($item, $auto->driver->license);
            array_push($item, $auto->id); //id

            array_push($data, $item);
        }

        // cache data todo  Remove after add new
        \Cache::put('autosData', $data, 900);

        return json_encode(['data' => $data]);;
    }

}
