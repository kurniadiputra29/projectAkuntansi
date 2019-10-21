@extends('layouts.app')

@section('title', 'AccountMin - Supplier')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-phone bg-blue"></i>
                        <div class="d-inline">
                            <h5>Supplier</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Supplier</li>
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
                  <h3>Supplier</h3>
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
                        <th class="col-2">Kode</th>
                        <th class="col-2">Nama</th>
                        <th class="col-3">NPWP</th>
                        <th class="col-3">Alamat</th>
                        <th class="col-1">Termin</th>
                        <th class="col-1">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>S0001</td>
                        <td>PT Alam Sutra</td>
                        <td>1.345.569.9.406.421</td>
                        <td>Jalan Veteran</td>
                        <td>2/10 net 50</td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>S0002</td>
                        <td>PT Nirwana</td>
                        <td>1.345.569.9.123.421</td>
                        <td>Jalan Apel</td>
                        <td>2/10 net 50</td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>S0003</td>
                        <td>PT Intan Tri Guna</td>
                        <td>1.345.569.9.456.421</td>
                        <td>Jalan Kenanga</td>
                        <td>2/10 net 50</td>
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
