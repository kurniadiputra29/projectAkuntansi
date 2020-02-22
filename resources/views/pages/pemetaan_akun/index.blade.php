@extends('layouts.app')

@section('title', 'AccountMin - Pemetaan Akun')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-settings bg-blue"></i>
                        <div class="d-inline">
                            <h5>Pemetaan Akun</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Pemetaan Akun</li>
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
                  <h3>Pemetaan Akun </h3>
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
                <form class="forms-sample" action="{{route('pemetaan_akun.update', $pemetaan_akuns->id)}}" method="post">
                  @csrf
                  @method('PUT')
                  <h4 class="sub-title text-center">Pemetaan Akun Cash</h4>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Akun Cash </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="cash">
                        <option value="0"> ~~ Pilih Cash ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->cash == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <h4 class="sub-title text-center">Pemetaan Akun Kas Kecil</h4>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Akun Kas Kecil </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="kas_kecil">
                        <option value="0"> ~~ Pilih Kas Kecil ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->kas_kecil == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <h4 class="sub-title text-center">Pemetaan Akun Hutang</h4>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Akun Hutang </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="hutang">
                        <option value="0"> ~~ Pilih Hutang ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->hutang == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <h4 class="sub-title text-center">Pemetaan Akun Piutang</h4>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Akun Piutang </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="piutang">
                        <option value="0"> ~~ Pilih Piutang ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->piutang == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <h4 class="sub-title text-center">Pemetaan Akun Persediaan Barang Dagang</h4>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Akun Persediaan </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="inventory">
                        <option value="0"> ~~ Pilih Persediaan ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->inventory == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <h4 class="sub-title text-center">Pemetaan Akun Transaksi Penjualan</h4>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Akun Penjualan Cash </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="penjualan_cash">
                        <option value="0"> ~~ Pilih Akun Penjualan Cash ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->penjualan_cash == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Akun Penjualan Credit </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="penjualan_credit">
                        <option value="0"> ~~ Pilih Akun Penjualan Credit ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->penjualan_credit == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> HPP Cash</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="hpp_penjualan_cash">
                        <option value="0"> ~~ Pilih HPP Cash ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->hpp_penjualan_cash == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> HPP Kredit</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="hpp_penjualan_credit">
                        <option value="0"> ~~ Pilih HPP Kredit ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->hpp_penjualan_credit == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Hutang Pajak Penjualan</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="ppn_penjualan">
                        <option value="0"> ~~ Pilih Hutang Pajak Penjualan ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->ppn_penjualan == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Pengiriman Penjualan </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="pengiriman_penjualan">
                        <option value="0"> ~~ Pilih Pengiriman Penjualan ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->pengiriman_penjualan == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Diskon Penjualan </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="diskon_penjualan">
                        <option value="0"> ~~ Pilih Diskon Penjualan ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->diskon_penjualan == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <h4 class="sub-title text-center">Pemetaan Akun Transaksi Pembelian</h4>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Pajak Pembelian </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="ppn_pembelian">
                        <option value="0"> ~~ Pilih Akun Penjualan Cash ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->ppn_pembelian == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Pengiriman Pembelian </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="pengiriman_pembelian">
                        <option value="0"> ~~ Pilih Akun Penjualan Cash ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->pengiriman_pembelian == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Diskon Pembelian </label>
                    <div class="col-sm-9">
                      <select class="form-control" id="setor_ke" name="diskon_pembelian">
                        <option value="0"> ~~ Pilih Diskon Pembelian ~~ </option>
                        @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$pemetaan_akuns->diskon_pembelian == $account->id ? 'selected' : ''}}>{{$account->nomor}} -- {{$account->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                  <div class="forms-sample" style="margin-bottom: 10px; margin-top: 30px; justify-content: space-between; display: flex;">
                    <a href="{{route('pemetaan_akun.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-refresh-ccw"></i>Reset</a>
                    <button class="btn btn-success btn-rounded"><i class="ik ik-plus-circle"></i> Edit</button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
  </div>

@endsection
