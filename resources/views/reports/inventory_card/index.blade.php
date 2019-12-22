@extends('layouts.app')

@section('title', 'Laporan Inventory Card')

@section('content')

  <div class="main-content">
        <div class="container-fluid">
          <div class="page-header">
            <div class="row align-items-end">
              <div class="col-lg-8">
                <div class="page-header-title">
                  <i class="ik ik-trending-up bg-blue"></i>
                  <div class="d-inline">
                    <h5>Inventory Card</h5>
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
                    <li class="breadcrumb-item active" aria-current="page">Inventory Card</li>
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
                    <h3>Inventory Card</h3>
                    <span>use class <code>table-hover</code> inside table element</span>
                  </div>
                  <div class="right-container">
                    <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                    <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                    <a type="button" class="btn btn-primary mr-5" href="{{route('inventory_card.print')}}"><i class="ik ik-printer"></i>Print</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="dt-responsive">
                    @foreach ($items as $item)
                      {{-- <h5 style="margin-top: 30px;">Item Name : {{ $item->nama }}</h5> --}}
                      <table id="complex-dt" class="table table-bordered nowrap">
                        <thead class="report-header">
                          <tr>
                            <th colspan="10">Item Name : {{ $item->nama }}</th>
                          </tr>
                          <tr class="bg-secondary font-weight-bold">
                            <th class="text-light text-center">Date</th>
                            <th class="text-light text-center">Kode Produk</th>
                            <th class="text-light text-center">Deskripsi</th>
                            <th class="text-light text-center">Status</th>
                            <th class="text-light text-center">QTY</th>
                            <th class="text-center text-light">Price/ Unit</th>
                            <th class="text-center text-light">Amount</th>
                            <th class="text-center text-light">QTY</th>
                            <th class="text-center text-light">Price/ Unit</th>
                            <th class="text-center text-light">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">{{date('d F Y', strtotime($item->created_at ))}}</td>
                            <td class="text-center">{{ $item->kode }}</td>
                            <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">{{ $item->status }}</td>
                            <td class="text-center">{{ $item->unit }}</td>
                            <td class="text-right">Rp {{ number_format($item->harga, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($item->nilai_persediaan, 0, " ", ".")}}</td>
                          </tr>
                          @foreach ($inventories as $inventory)
                            <tr>
                              @if ($inventory->items_id == $item->id)
                                <td class="text-center">{{date('d F Y', strtotime($inventory->created_at ))}}</td>
                                <td class="text-center">{{ $inventory->Items->kode }}</td>
                                <td class="text-center">@if ($inventory->crj_id != null)
                                  <span class="badge badge-pill badge-warning mb-1">CRJ</span>
                                @elseif($inventory->salesjournal_id != null)
                                  <span class="badge badge-pill badge-warning mb-1">Sales Journal</span>
                                @elseif($inventory->retur_penjualan_id != null)
                                  <span class="badge badge-pill badge-success mb-1">Retur Penjualan</span>
                                @elseif($inventory->cpj_id != null)
                                  <span class="badge badge-pill badge-success mb-1">CPJ</span>
                                @elseif($inventory->purchasejournal_id != null)
                                  <span class="badge badge-pill badge-success mb-1">Purchase Journal</span>

                                @elseif($inventory->retur_pembelian_id != null)
                                  <span class="badge badge-pill badge-warning mb-1">Retur Pembelian</span>
                                @endif
                              </td>
                              <td class="text-center">@if ($inventory->status == 0)
                                <span class="badge badge-pill badge-warning mb-1">~ Out ~</span>
                              @else
                                <span class="badge badge-pill badge-success mb-1">~ In ~</span>
                              @endif
                            </td>
                            <td class="text-center">{{ $inventory->unit }}</td>
                            <td class="text-right">Rp {{ number_format($inventory->price, 0, " ", ".")}}</td>
                            <td class="text-right">Rp {{ number_format($inventory->total, 0, " ", ".")}}</td>
                          @endif
                        </tr>
                      @endforeach
                      <tr class="bg-success text-light">
                        <td class="text-center grand-total" colspan="10">
                          {{ $item->kode }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                @endforeach
              </div>
              <div class="simpletable">
                <table id="simpletable" class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="5">Rekapitulasi</td>
                    </tr>
                    <tr>
                      <td>Kode</td>
                      <td>Item Name</td>
                      <td>Qty</td>
                      <td>Price</td>
                      <td>Amounts</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($distinct_pc as $rekap)
                      <tr>
                        <td>{{$rekap->kode}}</td>
                        <td>{{$rekap->nama}}</td>
                        <td class="text-right">
                          Rp {{number_format($distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('unit'))}}
                        </td>
                        <td class="text-right">
                          Rp {{number_format($distinct_pcc->where('items_id', $rekap->id)->sum('kredit'))}}
                        </td>
                        <td class="text-right">
                          Rp {{number_format($distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('total'))}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="3">Total</td>
                      <td class="text-light text-right"></td>
                      <td class="text-light text-right"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
