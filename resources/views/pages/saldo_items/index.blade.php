@extends('layouts.app')

@section('title', 'AccountMin - Saldo Items')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-box bg-blue"></i>
                        <div class="d-inline">
                            <h5>Saldo Items</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Saldo Items</li>
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
                  <h3>Saldo Items</h3>
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
                        <th class="text-right">Unit</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($SaldoItems as $key)
                        <tr>
                          <td>{{ $key->saldo_items->kode }}</td>
                          <td>{{ $key->saldo_items->nama }}</td>
                          <td class="text-right">{{ $key->unit }}</td>
                          <td class="text-right">Rp {{ number_format($key->price, 0, " ", ".")}}</td>
                          <td class="text-right">Rp {{ number_format($key->total, 0, " ", ".")}}</td>
                          <td class="text-right">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="aksiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown">
                                    <a href="{{route('saldo_item.edit', $key->id)}}" class="dropdown-item"><i class="ik ik-edit-2"> </i>Edit</a>
                                    <form method="post" action="{{ route('saldo_item.destroy', $key->id) }}">
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
                    <tfoot>
                      <tr class="bg-success font-weight-bold">
                        <td colspan="2" class="text-right text-light">Total</td>
                        <td class="text-right text-light">{{$SaldoItems->sum('unit')}}</td>
                        <td class="text-right text-light">Rp {{number_format($SaldoItems->sum('price'), 0, " ", ".")}}</td>
                        <td class="text-right text-light">Rp {{number_format($SaldoItems->sum('total'), 0, " ", ".")}}</td>
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
  @include('pages.saldo_items.create')

@endsection

@section('vue')
  <script type="text/javascript">
    new Vue({
    el: '#dwc',
    data: {
      unit: 0,
      price: 0,
    },
    computed: {
      totals(){
        var totals = this.unit*this.price;
        return totals;
      }, 
    },

  }); 
  </script>
@endsection
