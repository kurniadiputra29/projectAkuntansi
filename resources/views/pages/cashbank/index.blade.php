@extends('layouts.app')

@section('title',  'AccountMin - Cash & Bank')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
              <div class="d-inline">
                <h5>Cash & Bank</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Cash & Bank</li>
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
                <h3>Cash & Bank</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a class="btn btn-outline-primary btn-rounded" href="{{ route('cashbank.create') }}">Create</a>
              </div>
            </div>
            <div class="card-body">
              @if (count($errors) > 0)
                <div class="alert alert-dismissible fade show" role="alert">
                    <ul class="alert-danger list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item">{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ik ik-x"></i>
                    </button>
                </div>
                @endif
                @if (session('Success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('Success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ik ik-x"></i>
                    </button>
                </div>
                @endif
              <div class="dt-responsive">
                <table id="order-table" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                      {{-- <th>Status</th> --}}
                      <th class="text-right">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1-1110</td>
                      <td>Cash in Bank</td>
                      <td>Kas di bank</td>
                      <td>
                        <div class="table-actions">
                          <a href="#"><i class="ik ik-edit-2"></i></a>
                          <a href="#"><i class="ik ik-trash-2"></i></a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>1-1120</td>
                      <td>Petty Cash</td>
                      <td>Kas kecil</td>
                      <td>
                        <div class="table-actions">
                          <a href="#"><i class="ik ik-edit-2"></i></a>
                          <a href="#"><i class="ik ik-trash-2"></i></a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>1-2100</td>
                      <td>Stock Invesment</td>
                      <td>Investasi dalam saham</td>
                      <td>
                        <div class="table-actions">
                          <a href="#"><i class="ik ik-edit-2"></i></a>
                          <a href="#"><i class="ik ik-trash-2"></i></a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('pages.akun.create')

@endsection
