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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="dt-responsive">
                    @foreach ($items as $item)
                      {{-- <h5 style="margin-top: 30px;">Item Name : {{ $item->nama }}</h5> --}}
                      <table class="table table-bordered nowrap">
                        <thead class="report-header">
                          <tr class="bg-secondary font-weight-bold">
                            <th class="text-light" colspan="6">Item Name : {{ $item->nama }}</th>
                            <th class="text-light" colspan="1">Item Kode : {{ $item->kode }}</th>
                          </tr>
                          <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Kode Produk</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">Price/ Unit</th>
                            <th class="text-center">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($inventories as $inventory)
                            <tr>
                              @if ($inventory->items_id == $item->id)
                                <td class="text-center">{{date('d F Y', strtotime($inventory->tanggal ))}}</td>
                                <td class="text-center">{{ $inventory->Items->kode }}</td>
                                <td class="text-center">
                                  @if ($inventory->crj_id != null)
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
                                  @elseif($inventory->saldo_items_id != null)
                                    <span class="badge badge-pill badge-primary mb-1">Saldo Awal</span>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if ($inventory->saldo_items_id !== null)
                                    <span class="badge badge-pill badge-primary mb-1">~ In ~</span>
                                  @elseif($inventory->status == 1 )
                                    <span class="badge badge-pill badge-success mb-1">~ In ~</span>
                                  @elseif ($inventory->status == 0 )
                                    <span class="badge badge-pill badge-warning mb-1">~ Out ~</span>
                                  @endif
                                </td>
                                <td class="text-center">{{ $inventory->unit }}</td>
                                <td class="text-right">Rp {{ number_format($inventory->price, 0, " ", ".")}}</td>
                                <td class="text-right">Rp {{ number_format($inventory->total, 0, " ", ".")}}</td>
                              @endif
                            </tr>
                          @endforeach
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
                    @foreach ($items as $item)
                      <tr>
                        <td>{{$item->kode}}</td>
                        <td>{{$item->nama}}</td>
                        @php
                          $sum_tot_inventory_unit_in = 0;
                          $sum_tot_inventory_unit_out = 0;
                          $sum_tot_inventory_total_in = 0;
                          $sum_tot_inventory_total_out = 0;
                        @endphp
                        @foreach ($inventories as $inventory)
                          @if ($inventory->items_id == $item->id)
                            @if ($inventory->status == 1)
                              @php
                                $sum_tot_inventory_unit_in += $inventory->unit;
                                $sum_tot_inventory_total_in += $inventory->total;
                              @endphp
                            @else
                              @php
                                $sum_tot_inventory_unit_out += $inventory->unit;
                                $sum_tot_inventory_total_out += $inventory->total;
                              @endphp
                            @endif
                          @endif
                        @endforeach
                        <td class="text-right">
                          {{$sum_tot_inventory_unit_in - $sum_tot_inventory_unit_out}}
                        </td>
                        <td class="text-right">
                          Rp {{number_format(($sum_tot_inventory_total_in - $sum_tot_inventory_total_out) / ($sum_tot_inventory_unit_in - $sum_tot_inventory_unit_out), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                          Rp {{number_format($sum_tot_inventory_total_in - $sum_tot_inventory_total_out, 0, " ", ".")}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total</td>
                        @php
                          $sum_total_inventory_unit_in = 0;
                          $sum_total_inventory_unit_out = 0;
                          $sum_total_inventory_total_in = 0;
                          $sum_total_inventory_total_out = 0;
                        @endphp
                        @foreach ($items as $item)
                          @foreach ($inventories as $inventory)
                            @if ($inventory->items_id == $item->id)
                              @if ($inventory->status == 1)
                                @php
                                  $sum_total_inventory_unit_in += $inventory->unit;
                                  $sum_total_inventory_total_in += $inventory->total;
                                @endphp
                              @else
                                @php
                                  $sum_total_inventory_unit_out += $inventory->unit;
                                  $sum_total_inventory_total_out += $inventory->total;
                                @endphp
                              @endif
                            @endif
                          @endforeach
                        @endforeach
                      <td class="text-light text-right"> 
                        {{$sum_total_inventory_unit_in - $sum_total_inventory_unit_out}}
                      </td>
                      <td class="text-light text-right">
                        Rp {{number_format(($sum_total_inventory_total_in - $sum_total_inventory_total_out) / ($sum_total_inventory_unit_in - $sum_total_inventory_unit_out), 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        Rp {{number_format($sum_total_inventory_total_in - $sum_total_inventory_total_out, 0, " ", ".")}}
                      </td>
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
  @include('reports.inventory_card.show')
  @include('reports.inventory_card.pdf')

@endsection
