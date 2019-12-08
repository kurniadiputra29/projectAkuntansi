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
					<div class="table-container list-table">
						<div class="report-title">
							<div class="table-responsive">
								@foreach ($items as $item)
								<h5 style="margin-top: 30px;">Items Name : {{ $item->nama }}</h5>
								<table class="account-transactions report-table table" id="account-entry">
									<thead class="report-header">
										<tr class="bg-secondary font-weight-bold">
                      <th class="text-light">Tanggal</th>
                      <th class="text-light">Kode Produk</th>
                      <th class="text-light">Deskripsi</th>
                      <th class="text-light">Status</th>
                      <th class="text-light">QTY</th>
                      <th class="text-right text-light">Price/ Unit</th>
                      <th class="text-right text-light">Amount</th>
                      <th class="text-light">QTY</th>
                      <th class="text-right text-light">Price/ Unit</th>
                      <th class="text-right text-light">Amount</th>
                    </tr>
									</thead>
									<tbody>
                        <tr>
                          <td>{{date('d F Y', strtotime($item->created_at ))}}</td>
                          <td>{{ $item->kode }}</td>
                          <td><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                          <td>{{ $item->status }}</td>
                          <td>{{ $item->status }}</td>
                          <td>{{ $item->status }}</td>
                          <td>{{ $item->status }}</td>
                          <td>{{ $item->unit }}</td>
                          <td>Rp {{ number_format($item->harga, 0, " ", ".")}}</td>
                          <td>Rp {{ number_format($item->nilai_persediaan, 0, " ", ".")}}</td>
                        </tr>
                        @foreach ($inventories as $inventory)
                        <tr>
					                @if ($inventory->items_id == $item->id)
					                		<td>{{date('d F Y', strtotime($inventory->created_at ))}}</td>
					                		<td>{{ $inventory->Items->kode }}</td>
					                		<td>@if ($inventory->crj_id != null)
		                              	<span class="badge badge-pill badge-warning mb-1">CRJ</span>
		                              @elseif($inventory->salesjournal_id != null)
		                              	<span class="badge badge-pill badge-warning mb-1">Sales Journal</span>
		                              @elseif($inventory->retur_penjualan_id != null)
		                              	<span class="badge badge-pill badge-warning mb-1">Retur Penjualan</span>
		                              @elseif($inventory->cpj_id != null)
		                              	<span class="badge badge-pill badge-success mb-1">CPJ</span>
		                              @elseif($inventory->purchasejournal_id != null)
		                              	<span class="badge badge-pill badge-success mb-1">Purchase Journal</span>
		                              
		                              @elseif($inventory->retur_pembelian_id != null)
		                              	<span class="badge badge-pill badge-success mb-1">Retur Pembelian</span>
		                              @endif
		                          </td>
		                          <td>@if ($inventory->status == 0)
		                              <span class="badge badge-pill badge-warning mb-1">Out (Penjualan)</span>
		                              @else
		                              <span class="badge badge-pill badge-success mb-1">In (Pembelian)</span>
		                              @endif
		                          </td>
					                    <td>{{ $inventory->unit }}</td>
					                    <td>Rp {{ number_format($inventory->price, 0, " ", ".")}}</td>
					                    <td>Rp {{ number_format($inventory->total, 0, " ", ".")}}</td>
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
							<div class="text-left show-total-transaction bold-roboto-text" style="">
								Menampilkan total dari 4 baris transaksi
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
