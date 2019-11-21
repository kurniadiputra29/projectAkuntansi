<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PrintController extends Controller
{
    public function neraca()
    {
      return view('reports.neraca.index');
    }

    public function print_neraca()
    {
      $pdf = PDF::loadview('reports.neraca.print');
      return $pdf->stream();
    }
}
