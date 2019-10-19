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
                  <a href="http://localhost/ProjectAkuntan/index.php"><i class="ik ik-home"></i></a>
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
                <h3>Daftar Akun</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <button type="button" class="btn btn-outline-primary btn-rounded">Create</button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr class="row" style="display: contents;">
                      <th class="col-2">Nomor</th>
                      <th class="col-3">Nama</th>
                      <th class="col-5">Keterangan</th>
                      <th class="col-1">Status</th>
                      <th class="col-1">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1-1110</td>
                      <td>Cash in Bank</td>
                      <td>Kas di bank</td>
                      <td><span class="badge badge-pill badge-success mb-1">Aktif</span></td>
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
                      <td><span class="badge badge-pill badge-success mb-1">Aktif</span></td>
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
                      <td><span class="badge badge-pill badge-success mb-1">Aktif</span></td>
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

@endsection
