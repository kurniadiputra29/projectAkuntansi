<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DataPerusahaan;
use App\Http\Requests\DataPerusahaanRequest;

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
		public function store(DataPerusahaanRequest $request)
		{
			DataPerusahaan::create($request->all());

			return redirect('dasbor');
		}
}
