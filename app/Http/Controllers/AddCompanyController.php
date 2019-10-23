<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddCompanyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function form()
    {
      return view('others.addcompany.index');
    }
}
