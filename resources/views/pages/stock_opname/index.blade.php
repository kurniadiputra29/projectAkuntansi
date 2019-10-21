@extends('layouts.app')

@section('title', 'AccountMin - Stock Opname')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-truck bg-blue"></i>
                        <div class="d-inline">
                            <h5>Stock Opname</h5>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="http://localhost/ProjectAkuntan/index.php"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Stock Opname</li>
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
                  <h3>Saldo Awal</h3>
                  <span>use class <code>table-hover</code> inside table element</span>
                </div>
                <div class="right-container">
                  <button type="button" class="btn btn-outline-primary btn-rounded">Save</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr class="row" style="display: contents;">
                        <th class="col-2">Tanggal</th>
                        <th class="col-2">Kode</th>
                        <th class="col-3">Nama</th>
                        <th class="col-2">Jumlah Sistem</th>
                        <th class="col-2">Jumlah Sebenarnya</th>
                        <th class="col-1">Selisih</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>12-10-2019</td>
                        <td>AU-N06</td>
                        <td>Lemari Es</td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                      </tr>
                      <tr>
                        <td>12-10-2019</td>
                        <td>AU-N07</td>
                        <td>Kipas Angin</td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                      </tr>
                      <tr>
                        <td>12-10-2019</td>
                        <td>AU-N08</td>
                        <td>AC</td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
                        <td><input type="text" class="form-control form-control-sm" placeholder="0"></td>
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

@endsection
