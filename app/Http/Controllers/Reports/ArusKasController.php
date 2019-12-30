<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArusKasController extends Controller
{
    public function index()
    {
        return view('reports.arus_kas.index');
    }
}
