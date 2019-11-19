<?php

namespace App\Http\Controllers;
use App\Model\SaldoAwal;
use App\Model\Account;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;

class DasborController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $account = Account::all();
      $saldo_awal = SaldoAwal::orderBy('account_id', 'asc')->get();
      // untuk coba chart
      $kredit = $saldo_awal->sum('kredit');
      $debet = $saldo_awal->sum('debet');

      $a1 = SaldoAwal::get('account_id');
      $a2 = SaldoAwal::get('debet');

      $count = SaldoAwal::get('id')->count();

      foreach ($saldo_awal as $key) {
        // code...
        $ai = $key->account_id;
        $db = $key->debet;
      }

      // dd($ai);

        return view('pages.dasbor.index', compact('saldo_awal','kredit','debet','ai','db','account'));
    }

    public function cobaChart()
    {
      $saldo_awal = SaldoAwal::all();

      foreach ($saldo_awal as $key) {
        $k = $key->sum('kredit');
      }
      foreach ($saldo_awal as $key) {
        $d = $key->sum('debet');
      }
      $coba = [$k, $d];
      return response()->json($coba);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
