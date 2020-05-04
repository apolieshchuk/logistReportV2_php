<?php

namespace App\Http\Controllers;

use App\Autos;
use App\Cargos;
use App\Contacts;
use App\Posts;
use App\Routes;
use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index() {
        $auto_ids = explode(',', request()->cookie('ids'));
        $managers = Contacts::orderBy('updated_at', 'desc')
            ->where('post_id', Posts::where('name', 'Менеджер')
            ->first()->id)->get();
        return view('go', [
            'autos' => Autos::findMany($auto_ids),
            'routes' => Routes::orderBy('updated_at', 'desc')->orderBy('name', 'asc')->get(),
            'managers' => $managers,
            'cargos' => Cargos::orderBy('updated_at', 'desc')->orderBy('name', 'asc')->get()
        ]);
    }
}
