<?php

namespace App\Http\Controllers;

use App\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    public function index() {
        return view('auto', [
            'autos' => Auto::orderBy('name', 'asc')->get(),
        ]);
    }

}
