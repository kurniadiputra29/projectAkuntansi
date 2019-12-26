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
          <div class="card">
            <div class="card-header d-flex justify-content-between flex-row">
              <div class="left-container">
                <h3>Buku Besar</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              <div id="app">
                @php
                function format_uang($angka){
                  $hasil =  number_format($angka,2, ',' , '.');
                  return $hasil;
                }

                function sum_fun($w){
                  return ($w);
                }
                @endphp
                @foreach ($saldo_awal as $awal)
                  <table class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr class="bg-secondary font-weight-bold">
                        <th class="text-light" colspan="3">Nama Akun: {{$awal->account->nama}}</th>
                        <th class="text-light">Nomor Akun: {{$awal->account->nomor}}</th>
                      </tr>
                      <tr>
                        <th class="col-3">Tanggal</th>
                        <th class="col-3">Deskripsi</th>
                        <th class="col-3">Debet</th>
                        <th class="col-3">Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{date('d F Y', strtotime($awal->created_at ))}}</td>
                        <td>Saldo Awal</td>
                        <td>
                          Rp{{format_uang($awal->debet)}}
                        </td>
                        <td>
                          Rp{{format_uang($awal->kredit)}}
                        </td>
                      </tr>
                      {{-- $key_detail,$cpj_detail,$crj_detail,$jp_detail,$ju_detail,$pc_detail,$pj_detail,$sj_detail,$rpb_detail,$rpj_detail --}}
                      @foreach ($cbi_detail as $key)
                        @if ($key->nomor_akun == $awal->account->nomor)
                          <tr>
                            <td>{{date('d F Y', strtotime($key->CashBankIn->created_at ))}}</td>
                            <td>{{$key->CashBankIn->description}}</td>
                            <td>Rp{{format_uang($key->debet)}}</td>
                            <td>Rp{{format_uang($key->kredit)}}</td>
                          </tr>
                        @endif
                      @endforeach
                      @foreach ($cbo_detail as $key)
                        @if ($key->nomor_akun == $awal->account->nomor)
                          <tr>
                            <td>{{date('d F Y', strtotime($key->CashBankOut->created_at ))}}</td>
                            <td>{{$key->CashBankOut->description}}</td>
                            <td>Rp{{format_uang($key->debet)}}</td>
                            <td>Rp{{format_uang($key->kredit)}}</td>
                          </tr>
                        @endif
                      @endforeach
                      @foreach ($cpj_detail as $key)
                        @if ($key->nomor_akun == $awal->account->nomor)
                          <tr>
                            <td>{{date('d F Y', strtotime($key->cashinbank->created_at ))}}</td>
                            <td></td>
                            <td>Rp{{format_uang($key->debet)}}</td>
                            <td>Rp{{format_uang($key->kredit)}}</td>
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
                          </tr>
                        @endif
                      @endforeach
                      @foreach ($pc_detail as $key)
                        @if ($key->nomor_akun == $awal->account->nomor)
                          <tr>
                            <td>{{date('d F Y', strtotime($key->pettycash->created_at ))}}</td>
                            <td>{{$key->pettycash->description}}</td>
                            <td>Rp{{format_uang($key->debet)}}</td>
                            <td>Rp{{format_uang($key->kredit)}}</td>
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
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="bg-success font-weight-bold text-light">
                        <td></td>
                        <td>Total</td>
                        <td>Rp{{format_uang($awal->debet + $key->where('nomor_akun', $awal->account->nomor)->sum('debet'))}}</td>
                        <td>Rp{{format_uang($awal->kredit + $key->where('nomor_akun', $awal->account->nomor)->sum('kredit'))}}</td>
                      </tr>
                      <tr class="bg-primary font-weight-bold text-light">
                        <td></td>
                        <td>Balance</td>
                        <td class="text-center" colspan="2">Rp{{format_uang(($awal->debet + $key->where('nomor_akun', $awal->account->nomor)->sum('debet'))-($awal->kredit + $key->where('nomor_akun', $awal->account->nomor)->sum('kredit')))}}</td>
                      </tr>
                    </tfoot>
                  </table>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('vue')
  <script type="text/javascript">
    new Vue({
      el: '#app',
      data: {
        pesan: 'Gek rampung'
      }
    });
  </script>
@endsection
