@extends('layouts.app')

@section('title', 'Laporan Buku Besar')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Buku Besar</h5>
                <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/dasbor"><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/laporan">Laporan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Buku Besar</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row py-3">
            <div class="col-md-6">
              <form class="forms-sample" action="#" method="post">
                <label for="filter">Tanggal Mulai</label>
                <input type="date" name="tanggal" id="filter">
                <label for="filter2">Tanggal Akhir</label>
                <input type="date" name="tanggal" id="filter2">
                <button class="btn btn-primary" type="submit" name="button">Filter</button>
              </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
              <a type="button" class="btn btn-primary" href="#"><i class="ik ik-printer"></i>Print</a>
            </div>
          </div>
          <div>
            @php
            function format_uang($angka){
              $hasil =  number_format($angka,2, ',' , '.');
              return $hasil;
            }
            @endphp
            @foreach ($saldo_awal as $awal)
            <table class="table table-striped table-bordered nowrap">
              <thead>
                <tr class="bg-secondary font-weight-bold">
                  <th class="col-8 text-light" colspan="4">Nama Akun: {{$awal->account->nama}}</th>
                  <th class="col-4 text-light" colspan="2">Nomor Akun: {{$awal->account->nomor}}</th>
                </tr>
                <tr>
                  <th class="col-2" rowspan="2">Tanggal</th>
                  <th class="col-2" rowspan="2">Deskripsi</th>
                  <th class="col-2" rowspan="2">Debet</th>
                  <th class="col-2" rowspan="2">Kredit</th>
                  <th class="col-4" colspan="2" style="text-align: center;">Balance</th>
                </tr>
                <tr>
                  <th class="col-2">Debet</th>
                  <th class="col-2">Kredit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{date('d F Y', strtotime($awal->created_at ))}}</td>
                  <td>Saldo Awal</td>
                  <td></td>
                  <td></td>
                  <td>Rp{{format_uang($awal->debet)}}</td>
                  <td>Rp{{format_uang($awal->kredit)}}</td>
                </tr>
                {{-- $key_detail,$cpj_detail,$crj_detail,$jp_detail,$ju_detail,$pc_detail,$pj_detail,$sj_detail,$rpb_detail,$rpj_detail --}}
                @foreach ($cb_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->cashinbank->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($cpj_detail as $key)
                  @if ($key->nomor_akun == $awal->cpjs->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->cashinbank->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($crj_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->crjs->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($jp_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->jurnalpenyesuaians->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($ju_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->jurnal_umums->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($pc_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->pettycash->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($pj_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->purchase_journals->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($sj_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->seles_journals->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($rpb_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->retur_pembelians->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
                @foreach ($rpj_detail as $key)
                  @if ($key->nomor_akun == $awal->account->nomor)
                    <tr>
                      <td>{{date('d F Y', strtotime($key->retur_penjualans->created_at ))}}</td>
                      <td></td>
                      <td>Rp{{format_uang($key->debet)}}</td>
                      <td>Rp{{format_uang($key->kredit)}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
