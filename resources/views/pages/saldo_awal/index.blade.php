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
                                <a href="http://localhost/ProjectAkuntan/index.php"><i class="ik ik-home"></i></a>
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
                <div class="dt-responsive">
                  <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th class="text-right">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($dataSaldoAwal as $key)
                        <tr>
                          <td>{{ $key->account_id }}</td>
                          <td>{{ $key->account_id }}</td>
                          <td>{{ $key->debet }}</td>
                          <td>{{ $key->kredit }}</td>
                          <td class="text-right">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="aksiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown">
                                    <button class="dropdown-item" data-toggle="modal" data-target="#editModal_{{ $key->id }}"><i class="ik ik-edit-2"></i> Edit</button>
                                    <form method="post" action="{{ route('supplier.destroy', $key->id) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button class="dropdown-item" type="submit"><i class="ik ik-trash-2"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                          </td>
                        </tr>
                        @include('pages.saldo_awal.edit')
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
  @include('pages.saldo_awal.create')

@endsection
