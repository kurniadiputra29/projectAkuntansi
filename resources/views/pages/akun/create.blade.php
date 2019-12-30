@extends('layouts.app')

@section('title', 'AccountMin - Tambah Akun')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
              <div class="d-inline">
                <h5>Tambah Akun</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Tambah Akun</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form class="forms-sample" id="a" action="{{route('akun.store')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="nomor">Nomor Akun</label>
                  <input type="text" class="form-control" name="nomor" id="nomor" placeholder="X-XXXXX">
                </div>
                <div class="form-group">
                  <label for="nama">Nama Akun</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Akun">
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" id="keterangan">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
