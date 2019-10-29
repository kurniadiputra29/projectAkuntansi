@extends('layouts.app')

@section('title',  'AccountMin - Akun')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
              <div class="d-inline">
                <h5>Daftar Akun</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Daftar Akun</li>
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
                <h3>Edit Akun</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a href="/akun" type="button" class="btn btn-outline-primary btn-rounded">Back</a>
              </div>
            </div>
            <div class="card-body">
              <form class="forms-sample" action="{{route('akun.update', $data->id)}}" method="post">
                @csrf
                @method('PUT')
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="nomor">Nomor Akun</label>
                            <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $data->id }}">
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor Akun</label>
                            <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $data->nomor }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Akun</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $data->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $data->keterangan }}">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
