@extends('layouts.app')

@section('title', 'AccountMin - Retur Pembelian')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-blue"></i>
                        <div class="d-inline">
                            <h5>Retur Pembelian</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Retur Pembelian</li>
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
                  <h3>Retur Pembelian</h3>
                  <span>use class <code>table-hover</code> inside table element</span>
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
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Customers</th>
                        <th>Deskripsi</th>
                        <th class="text-right">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key)
                        <tr>
                          <td>{{ $key->kode }}</td>
                          <td>{{date('d F Y', strtotime($key->tanggal))}}</td>
                          <td>{{ $key->data_suppliers->nama }}</td>
                          <td>{{ $key->description }}</td>
                          <td class="text-right">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="aksiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown">
                                    <a href="{{route('retur_pembelian.edit', $key->id)}}" class="dropdown-item"><i class="ik ik-edit-2"> </i>Edit</a>
                                    <form method="get" action="{{ route('retur_pembelian.show', $key->id) }}">
                                      @csrf
                                      @method('GET')
                                      <button class="dropdown-item" type="submit"><i class="ik ik-eye"></i> Journal</button>
                                    </form>
                                    <form method="post" action="{{ route('retur_pembelian.destroy', $key->id) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button class="dropdown-item" type="submit" onclick='javascript:return confirm("Apakah anda yakin ingin menghapus data ini?")'><i class="ik ik-trash-2"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
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
