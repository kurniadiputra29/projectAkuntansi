@extends('layouts.app')

@section('title', 'AccountMin - Saldo Awal')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-database bg-blue"></i>
                        <div class="d-inline">
                            <h5>Saldo Awal</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Saldo Awal</li>
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
                  <button type="button" class="btn btn-outline-primary btn-rounded" data-toggle="modal" data-target="#createModal">Create</button>
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
                <div class="dt-responsive">
                  <table id="simpletable" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th class="text-right">Debet</th>
                        <th class="text-right">Kredit</th>
                        <th class="text-right">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($dataSaldoAwal as $key)
                        <tr>
                          <td>{{ $key->account->nomor }}</td>
                          <td>{{ $key->account->nama }}</td>
                          <td class="text-right">Rp {{ number_format($key->debet, 0, " ", ".")}}</td>
                          <td class="text-right">Rp {{ number_format($key->kredit, 0, " ", ".")}}</td>
                          <td class="text-right">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="aksiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown">
                                    <button class="dropdown-item" data-toggle="modal" data-target="#editModal_{{ $key->id }}"><i class="ik ik-edit-2"></i> Edit</button>
                                    <form method="post" action="{{ route('saldo_awal.destroy', $key->id) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button class="dropdown-item" type="submit" onclick='javascript:return confirm("Apakah anda yakin ingin menghapus data ini?")'><i class="ik ik-trash-2"></i> Delete</button>
                                    </form>
                                </div>
                              </div>
                            </td>
                          </tr>
                        @include('pages.saldo_awal.edit')
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="bg-success font-weight-bold">
                        <td colspan="2" class="text-right text-light">Total</td>
                        <td class="text-right text-light">{{number_format($dataSaldoAwal->sum('debet'), 0, " ", ".")}}</td>
                        <td class="text-right text-light">{{number_format($dataSaldoAwal->sum('kredit'), 0, " ", ".")}}</td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  @include('pages.saldo_awal.create')

@endsection
