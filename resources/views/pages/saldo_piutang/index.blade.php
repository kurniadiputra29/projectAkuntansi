@extends('layouts.app')

@section('title', 'AccountMin - Saldo Piutang')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-database bg-blue"></i>
                        <div class="d-inline">
                            <h5>Saldo Piutang</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Saldo Piutang</li>
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
                  <h3>Saldo Piutang</h3>
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
                        <th class="col-2">Kode</th>
                        <th class="col-3">Nama</th>
                        <th class="col-3">Keterangan</th>
                        <th class="col-3">Saldo</th>
                        <th class="col-1">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>C0001</td>
                        <td>Toko Sanex</td>
                        <td></td>
                        <td><input type="text" class="form-control form-control-sm" value="0"></td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>C0002</td>
                        <td>Toko Niaga</td>
                        <td></td>
                        <td><input type="text" class="form-control form-control-sm" value="0"></td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>C0003</td>
                        <td>Toko Contoh</td>
                        <td></td>
                        <td><input type="text" class="form-control form-control-sm" value="0"></td>
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
