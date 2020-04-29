<?php

namespace App\Http\Controllers;

use App\Autos;
use App\Routes;
use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index() {
        $auto_ids = explode(',',request()->cookie('ids'));
        return view('go', [
            'autos' => Autos::findMany($auto_ids),
            'routes' => Routes::all(),
        ]);
    }
}
