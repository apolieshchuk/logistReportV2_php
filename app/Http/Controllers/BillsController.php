<?php

namespace App\Http\Controllers;

use App\Bills;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function index() {
        $bills = Bills::with(['carrier:id,name','payer:id,name','route:id,name'])
        ->get();
        return view('bills', compact('bills', $bills));
    }
}
