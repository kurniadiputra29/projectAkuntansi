@extends('layouts.app')

@section('title', 'AccountMin - Create CashBank?')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
              <div class="d-inline">
                <h5>Create Cash & Bank</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Create</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Basic form elements</h3></div>
                <div class="card-body">
                  <form class="forms-sample">
                    <div class="row input-group-primary">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="setor_ke">Setor Ke</label>
                          <select class="form-control" id="setor_ke">
                            @foreach ($akun as $key)
                              <option>{{$key->nomor}} - {{$key->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="yang_membayar">Yang Membayar</label>
                          <input class="form-control" type="text" id="yang_membayar">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="tanggal_transaksi">Tanggal Transaksi</label>
                          <input class="form-control" type="date" id="tanggal_transaksi">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="no_transaksi">Nomor Transaksi</label>
                          <input class="form-control" type="text" id="no_transaksi">
                        </div>
                      </div>
                    </div>

                    <div style="margin-bottom: 100px;"></div>

                    <div class="card">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Terima Dari</th>
                              <th>Deskripsi</th>
                              <th>Pajak</th>
                              <th>Jumlah</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </th>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <select class="form-control" id="setor_ke">
                                    @foreach ($akun as $key)
                                      <option>{{$key->nama}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </th>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <select class="form-control" id="setor_ke">
                                    @foreach ($akun as $key)
                                      <option>{{$key->nama}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </th>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <select class="form-control" id="setor_ke">
                                    @foreach ($akun as $key)
                                      <option>{{$key->nama}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="no_transaksi">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Total</label>
                          <input class="form-control" type="text" id="no_transaksi">
                        </div>
                      </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                      <div class="col-md-4">
                        <a class="btn btn-outline-primary btn-rounded" href="{{ route('cashbank.create') }}">Create</a>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>Input Sizes</h3></div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control form-control-lg" placeholder=".form-control-lg">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder=".form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" placeholder=".form-control-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3>Text-color</h3></div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control form-txt-primary" placeholder=".form-txt-primary">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-txt-warning" placeholder=".form-txt-warning">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-txt-default" placeholder=".form-txt-default">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-txt-danger" placeholder=".form-txt-danger">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-txt-success" placeholder=".form-txt-success">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-txt-inverse" placeholder=".form-txt-inverse">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-txt-info" placeholder=".form-txt-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>Color Inputs</h3></div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-primary" placeholder=".form-control-primary">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-warning" placeholder=".form-control-warning">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-default" placeholder=".form-control-default">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-danger" placeholder=".form-control-danger">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-success" placeholder=".form-control-success">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-inverse" placeholder=".form-control-inverse">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-info" placeholder=".form-control-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>Background-color</h3></div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control form-bg-primary" placeholder=".form-bg-primary">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-bg-warning" placeholder=".form-bg-warning">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-bg-default" placeholder=".form-bg-default">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-bg-danger" placeholder=".form-bg-danger">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-bg-success" placeholder=".form-bg-success">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-bg-inverse" placeholder=".form-bg-inverse">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-bg-info" placeholder=".form-bg-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="min-height: 180px;">
                <div class="card-header"><h3>Inline forms</h3></div>
                <div class="card-body">
                    <form class="form-inline">
                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Shanker Raj">

                        <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                        </div>
                        <div class="form-check mx-sm-2">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked>
                                <span class="custom-control-label">&nbsp; Remember Me</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>Validation States</h3></div>
                <div class="card-body">
                    <form class="forms-sample">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control is-valid" id="exampleInputName1" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" class="form-control is-invalid" id="exampleInputEmail3" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
      </div>
    </div>
  </div>

@endsection
