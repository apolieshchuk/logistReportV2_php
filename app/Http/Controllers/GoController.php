<?php

namespace App\Http\Controllers;

use App\Auto;
use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index() {
        $auto_ids = explode(',',request()->cookie('ids'));
//         dd($auto_ids);
        return view('go', [
            'autos' => Auto::findMany($auto_ids),
        ]);
    }
}
