@extends('layouts.app')

@section('title', 'AccountMin - Sales Journal')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-package bg-blue"></i>
                        <div class="d-inline">
                            <h5>Sales Journal</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Sales Journal</li>
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
                  <h3>Sales Journal</h3>
                  <span>use class <code>table-hover</code> inside table element</span>
                </div>
                <div class="right-container">
                  <a class="btn btn-outline-primary btn-rounded" href="{{route('sales_journal.create') }}">Create</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr class="row" style="display: contents;">
                        <th class="col-1">Tanggal</th>
                        <th class="col-1">Kode</th>
                        <th class="col-2">Deskripsi</th>
                        <th class="col-1">No Akun</th>
                        <th class="col-2">Nama Akun</th>
                        <th class="col-2">Debet</th>
                        <th class="col-2">Kredit</th>
                        <th class="col-1">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>13-10-2019</td>
                        <td>SJ002</td>
                        <td>Toko Sanex</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>12-10-2019</td>
                        <td>SJ001</td>
                        <td>Toko MAJU JAYA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
