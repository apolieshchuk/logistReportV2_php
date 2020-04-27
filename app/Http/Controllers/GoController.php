<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index() {
        request('ids');

        echo "hello wotdl";
    }
}
