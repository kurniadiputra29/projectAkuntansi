@extends('layouts.app')

@section('title', 'AccountMin - Penerimaan Piutang')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-briefcase bg-blue"></i>
                        <div class="d-inline">
                            <h5>Penerimaan Piutang</h5>
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
                            <li class="breadcrumb-item" aria-current="page">
                              <a href="/penerimaan_piutang">Penerimaan Piutang</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                  <h3>Detail</h3>
                  <span>use class <code>table-hover</code> inside table element</span>
                </div>
                <div class="right-container">
                  <a class="btn btn-outline-secondary btn-rounded" href="{{ route('penerimaan_piutang.index') }}"><i class="ik ik-arrow-left"></i> Back</a>
                </div>
              </div>
              <div class="card-body">
                <div class="dt-responsive">
                  <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>Nomor Akun</th>
                        <th>Nama Akun</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($detail as $key)
                        <tr>
                          <td>{{ $key->nomor_akun }}</td>
                          <td>{{ $key->nama_akun }}</td>
                          <td>Rp {{ number_format($key->debet, 0, " ", ".")}}</td>
                          <td>Rp {{ number_format($key->kredit, 0, " ", ".")}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

@endsection
