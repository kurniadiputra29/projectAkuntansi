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
              <div class="right-container d-flex flex-row">
                <a type="button" class="btn btn-success mr-5" href="/inventory"><i class="ik ik-arrow-left"></i>Back</a>
                <form class="" action="{{route('inventory.printF')}}" method="post">
                  @csrf
                  <input type="hidden" name="tanggal_mulai" value="{{$tanggal_mulai}}">
                  <input type="hidden" name="tanggal_akhir" value="{{$tanggal_akhir}}">
                  <button type="submit" class="btn btn-primary"><i class="ik ik-printer"></i>Print</button>
                </form>
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
                            <td class="text-center">{{date('d F Y', strtotime($inventory->created_at ))}}</td>
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
                    @foreach ($distinct_pc as $rekap)
                      <tr>
                        <td>{{$rekap->kode}}</td>
                        <td>{{$rekap->nama}}</td>
                        <td class="text-right">
                          {{$distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('unit')-$distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('unit')}}
                        </td>
                        <td class="text-right">
                          Rp {{number_format(($distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('total') - $distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('total')) / ($distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('unit')-$distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('unit')), 0, " ", ".")}}
                        </td>

                        <td class="text-right">
                          Rp {{number_format($distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('total') - $distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('total'), 0, " ", ".")}}
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
  @include('reports.inventory_card.pdf')

@endsection
