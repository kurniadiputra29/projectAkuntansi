<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pettycash;
use App\Model\Account;
use App\Model\PettycashDetail;
use App\Model\SaldoAwal;

class KasKecilController extends Controller
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
			$data = Pettycash::orderBy('created_at', 'desc')->get();
				return view('pages.kas_kecil.index', compact('data'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			$akun 			= Account::all();
			$pettycashs 	= Pettycash::orderBy('id', 'desc')->paginate(1);
        	$pettycashs_count 	= Pettycash::all()->count();
			return view('pages.kas_kecil.create', compact('akun', 'pettycashs', 'pettycashs_count'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			$messages = [
						'required' => ':attribute wajib diisi !!!',
						'unique' => ':attribute harus diisi dengan syarat unique !!!',
				];
				$this->validate($request,[
						'tanggal' => 'required',
						'penerima' => 'required',
						'description' => 'required',
						'kode' => 'unique:pettycashes,kode|required',
				],$messages);


			// ngecheck data yang mau dimasukkan
			$checkDataMasukNggak = $request->all();
			// dd($checkDataMasukNggak);
				//insert data pettycash
				$dataKasKecil = $request->only('id', 'tanggal', 'kode', 'penerima', 'description');
				$pettycash = Pettycash::create($dataKasKecil);

				//insert data pettycash detail
				// versi adib
				$detailKasKecil2 = $request->only('id_akun', 'nomor_akun2', 'nama_akun2', 'nomor_akun', 'nama_akun', 'akun_id', 'jumlah', 'total');
				$nomorAkun1 = count($detailKasKecil2['total']);
				$nomorAkun2 = count($detailKasKecil2['nomor_akun']);

				for ($a=0; $a < $nomorAkun1; $a++) {
					$detail                     = new PettycashDetail();
					$detail->pettycash_id       = $pettycash->id;
					$detail->nomor_akun         = $detailKasKecil2['nomor_akun2'][$a];
					$detail->nama_akun          = $detailKasKecil2['nama_akun2'][$a];
					$detail->kredit              = $detailKasKecil2['total'][$a];
					$detail->save();
				}

				for ($i=0; $i < $nomorAkun2; $i++) {
					$detail                     = new PettycashDetail();
					$detail->pettycash_id       = $pettycash->id;
					$detail->nomor_akun         = $detailKasKecil2['nomor_akun'][$i];
					$detail->nama_akun          = $detailKasKecil2['nama_akun'][$i];
					$detail->debet              = $detailKasKecil2['jumlah'][$i];
					$detail->save();
				}

				return redirect('kas_kecil')->with('Success', 'Data anda telah berhasil di input !');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			$detail = PettycashDetail::where('pettycash_id', $id)->get();
				return view('pages.kas_kecil.show', compact('detail'));
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			$akun = Account::all();
			$pettycashs     = Pettycash::find($id);
			$kredits = PettycashDetail::where('pettycash_id', $id)->where('debet', null)->get();

			return view('pages.kas_kecil.edit', compact('akun', 'pettycashs', 'kredits'));
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

			$messages = [
						'required' => ':attribute wajib diisi !!!',
						'unique' => ':attribute harus diisi dengan syarat unique !!!',
				];
				$this->validate($request,[
						'tanggal' => 'required',
						'penerima' => 'required',
						'description' => 'required',
						'kode' => 'unique:pettycashes,kode,'.$id,
				],$messages);

				//insert data pettycash
				$dataKasKecil     = $request->only('id', 'tanggal', 'kode', 'penerima', 'description');
				$pettycash        = Pettycash::find($id)->update($dataKasKecil);

				//insert data pettycash detail
				$detailKasKecil2  = $request->only('id_akun', 'nomor_akun', 'nama_akun', 'nomor_akun2', 'nama_akun2', 'jumlah', 'total');
				$nomorAkun1       = count($detailKasKecil2['nomor_akun']);
				$nomorAkun2       = count($detailKasKecil2['total']);

				PettycashDetail::where('pettycash_id', $id)->delete();

				for ($a=0; $a < $nomorAkun2; $a++) {
						$detail                     = new PettycashDetail();
						$detail->pettycash_id       = $id;
						$detail->nomor_akun         = $detailKasKecil2['nomor_akun2'][$a];
						$detail->nama_akun          = $detailKasKecil2['nama_akun2'][$a];
						$detail->kredit             = $detailKasKecil2['total'][$a];
						$detail->save();
				}

				for ($i=0; $i < $nomorAkun1; $i++) {
					$detail                     = new PettycashDetail();
					$detail->pettycash_id       = $id;
					$detail->nomor_akun         = $detailKasKecil2['nomor_akun'][$i];
					$detail->nama_akun          = $detailKasKecil2['nama_akun'][$i];
					$detail->debet              = $detailKasKecil2['jumlah'][$i];
					$detail->save();
				}

				return redirect('kas_kecil')->with('Success', 'Data anda telah berhasil di Edit !');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
				Pettycash::find($id)->delete();
				//PettycashDetail::where('pettycash_id', $id)->delete();
				return redirect('kas_kecil')->with('Success', 'Data anda telah berhasil di delete !');
		}
}
