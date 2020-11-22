<?php

namespace Enburn\CarRegistry\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('vr::index');
    }
}
