<?php

namespace App\Http\Controllers;
use App\Model\SaldoAwal;
use App\Model\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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
        $asset          = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->get();
        $liability      = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->get();
        $equity         = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->get();
        $tot_deb_ner    = $asset->sum('debet')+$liability->sum('debet')+$equity->sum('debet');
        $tot_kre_ner    = $asset->sum('kredit')+$liability->sum('kredit')+$equity->sum('kredit');
        $balance_ner    = $tot_deb_ner-$tot_kre_ner;
        $deb_ner_sal    = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->sum('debet');
        $kre_ner_sal    = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->sum('kredit');

        // dd($tot_deb_ner);

        return view('pages.dasbor.index', compact('asset','liability','equity','tot_deb_ner','tot_kre_ner','balance_ner','deb_ner_sal','kre_ner_sal'));
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
