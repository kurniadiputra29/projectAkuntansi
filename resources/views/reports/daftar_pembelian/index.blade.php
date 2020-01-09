@extends('layouts.app')

@section('title', 'Laporan Daftar Pembelian')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Daftar Pembelian</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Daftar Pembelian</li>
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
                <h3>Daftar Pembelian</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              @if (session('Success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('Success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="ik ik-x"></i>
                  </button>
              </div>
              @endif
              <div class="dt-responsive">
                <table id="complex-dt" class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <th class="text-light">Tanggal</th>
                      <th class="text-light">Transaksi</th>
                      <th class="text-light">Nomor</th>
                      <th class="text-light">Pelanggan</th>
                      <th class="text-light">Status</th>
                      <th class="text-light">Keterangan</th>
                      <th class="text-light">Total tagihan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cpjs as $cpj)
                      <tr>
                        <td>{{date('d F Y', strtotime($cpj->tanggal ))}}</td>
                        <td class="text-center"><span class="badge badge-pill badge-primary mb-1">CPJ</span></td>
                        <td>{{$cpj->kode}}</td>
                        <td>{{$cpj->data_suppliers->nama}}</td>
                        <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Pembelian Tunai</span></td>
                        <td>{{$cpj->description}}</td>
                        <td class="text-right">
                          Rp {{number_format($cpjdetails->where('cpj_id', $cpj->id)->sum('debet'), 0, " ", ".")}}
                        </td>
                      </tr>
                    @endforeach
                    @foreach ($PurchaseJournals as $PurchaseJournal)
                      <tr>
                        <td>{{date('d F Y', strtotime($PurchaseJournal->tanggal ))}}</td>
                        <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Sales Journal</span></td>
                        <td>{{$PurchaseJournal->kode}}</td>
                        <td>{{$PurchaseJournal->data_suppliers->nama}}</td>
                        <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Pembelian Kredit</span></td> 
                        <td>{{$PurchaseJournal->description}}</td>
                        <td class="text-right">
                          Rp {{number_format($purchasejournaldetails->where('purchasejournal_id', $PurchaseJournal->id)->sum('debet'), 0, " ", ".")}}
                        </td>
                      </tr>
                    @endforeach
                    @foreach ($ReturPembelians as $ReturPembelian)
                      <tr>
                        <td>{{date('d F Y', strtotime($ReturPembelian->tanggal ))}}</td>
                        <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Retur Pembelian</span></td>
                        <td>{{$ReturPembelian->kode}}</td>
                        <td>{{$ReturPembelian->data_suppliers->nama}}</td>
                        <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Retur</span></td> 
                        <td>{{$ReturPembelian->description}}</td>
                        <td class="text-right">
                          Rp {{number_format($ReturPembelianDetails->where('retur_pembelians_id', $ReturPembelian->id)->sum('debet'), 0, " ", ".")}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="6">Total</td>
                      <td class="text-light text-right">
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
