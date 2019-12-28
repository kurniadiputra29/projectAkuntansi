<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NeracaLajurController extends Controller
{
    public function index()
    {
       return view('reports.neraca_lajur.index');
    }
}
