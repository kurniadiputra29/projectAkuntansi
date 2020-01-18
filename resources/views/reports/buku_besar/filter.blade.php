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
              <div class="right-container d-flex flex-row">
                <a type="button" class="btn btn-success mr-5" href="/buku_besar"><i class="ik ik-arrow-left"></i>Back</a>
                <form class="" action="{{route('buku_besar.printF')}}" method="post">
                  @csrf
                  <input type="hidden" name="tanggal_mulai" value="{{$tanggal_mulai}}">
                  <input type="hidden" name="tanggal_akhir" value="{{$tanggal_akhir}}">
                  <button type="submit" class="btn btn-primary"><i class="ik ik-printer"></i>Print</button>
                </form>
              </div>
            </div>
            <div class="card-body">
              <div id="app">
                @foreach ($accounts as $account)
                  <table class="table table-bordered nowrap">
                    <thead class="report-header">
                      <tr class="bg-secondary font-weight-bold">
                        <th class="text-light" colspan="4">Nama Akun: {{$account->nama}} ( {{$account->nomor}} )</th>
                      </tr>
                      <tr>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Debet</th>
                        <th class="text-center">Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($saldo_awals as $saldo_awal)
                        <tr>
                          @if ($saldo_awal->account_id == $account->id)
                            <td class="text-center">{{date('d F Y', strtotime($saldo_awal->created_at ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                            <td class="text-right">Rp {{ number_format($saldo_awal->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($saldo_awal->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($cbi_details as $cbi_detail)
                        <tr>
                          @if ($cbi_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($cbi_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Bank In</span></td>
                            <td class="text-right">Rp {{ number_format($cbi_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($cbi_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($cbo_details as $cbo_detail)
                        <tr>
                          @if ($cbo_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($cbo_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Bank Out</span></td>
                            <td class="text-right">Rp {{ number_format($cbo_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($cbo_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($cpj_details as $cpj_detail)
                        <tr>
                          @if ($cpj_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($cpj_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Payment Journal</span></td>
                            <td class="text-right">Rp {{ number_format($cpj_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($cpj_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($crj_details as $crj_detail)
                        <tr>
                          @if ($crj_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($crj_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Receipt Journal</span></td>
                            <td class="text-right">Rp {{ number_format($crj_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($crj_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($pj_details as $pj_detail)
                        <tr>
                          @if ($pj_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($pj_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Purchase Journal</span></td>
                            <td class="text-right">Rp {{ number_format($pj_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($pj_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($sj_details as $sj_detail)
                        <tr>
                          @if ($sj_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($sj_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Sales Journal</span></td>
                            <td class="text-right">Rp {{ number_format($sj_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($sj_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($rpb_details as $rpb_detail)
                        <tr>
                          @if ($rpb_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($rpb_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Retur Pembelian</span></td>
                            <td class="text-right">Rp {{ number_format($rpb_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($rpb_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($rpj_details as $rpj_detail)
                        <tr>
                          @if ($rpj_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($rpj_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Retur Penjualan</span></td>
                            <td class="text-right">Rp {{ number_format($rpj_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($rpj_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($ju_details as $ju_detail)
                        <tr>
                          @if ($ju_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($ju_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Jurnal Umum</span></td>
                            <td class="text-right">Rp {{ number_format($ju_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($ju_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      @foreach ($pc_details as $pc_detail)
                        <tr>
                          @if ($pc_detail->nomor_akun == $account->nomor)
                            <td class="text-center">{{date('d F Y', strtotime($pc_detail->tanggal ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-success mb-1">Kas Kecil</span></td>
                            <td class="text-right">Rp {{ number_format($pc_detail->debet, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($pc_detail->kredit, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="bg-success font-weight-bold">
                        <td class="text-light text-center" colspan="2">Balance</td>
                        <td class="text-light text-right">
                            Rp {{number_format($distinct_laporan->where('nomor_akun', $account->nomor)->sum('debet') + $distinct_laporan->where('account_id', $account->id)->sum('debet'), 0, " ", ".")}}
                        </td>
                        <td class="text-light text-right">
                            Rp {{number_format($distinct_laporan->where('account_id', $account->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $account->nomor)->sum('kredit'), 0, " ", ".")}}
                        </td>
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
  @include('reports.buku_besar.pdf')
  @include('reports.buku_besar.show')

@endsection

@section('vue')
  <script type="text/javascript">
    new Vue({
      el: '#app',
      data: {
        items: [
          {
            debet: 1,
            kredit: 1,
          }
        ],
      }
    });
  </script>
@endsection