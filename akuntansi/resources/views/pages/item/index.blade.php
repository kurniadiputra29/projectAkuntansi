@extends('layouts.app')

@section('title', 'AccountMin - Item')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-box bg-blue"></i>
                        <div class="d-inline">
                            <h5>Item</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Item</li>
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
                  <h3>Item</h3>
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
                        <th class="col-3">Nama</th>
                        <th class="col-2">Unit</th>
                        <th class="col-2">Harga/unit</th>
                        <th class="col-2">Nilai Persediaan</th>
                        <th class="col-1">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>AU-N06</td>
                        <td>Lemari Es</td>
                        <td>40</td>
                        <td>2.000.000</td>
                        <td>80.000.000</td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>AU-N07</td>
                        <td>Kipas Angin</td>
                        <td>10</td>
                        <td>250.000</td>
                        <td>2.500.000</td>
                        <td>
                          <div class="table-actions">
                            <a href="#"><i class="ik ik-edit-2"></i></a>
                            <a href="#"><i class="ik ik-trash-2"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>AU-N08</td>
                        <td>AC</td>
                        <td>40</td>
                        <td>2.500.000</td>
                        <td>100.000.000</td>
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
