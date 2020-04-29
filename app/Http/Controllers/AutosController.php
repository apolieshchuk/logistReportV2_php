<?php

namespace App\Http\Controllers;

use App\Autos;
use Illuminate\Http\Request;

class AutosController extends Controller
{
    public function index() {
        return view('auto', [
            'autos' => Autos::orderBy('carrier_id', 'asc')->get(),
        ]);
    }

}
