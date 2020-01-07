@extends('layouts.app')

@section('title', 'AccountMin - Saldo Items')

@section('content')

<div class="main-content">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-lg-8">
          <div class="page-header-title">
            <i class="ik ik-menu bg-blue"></i>
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
              <li class="breadcrumb-item" aria-current="page">
                <a href="/retur_pembelian">Saldo Items</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <div class="row" id="app">
      <div class="col-md-12">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        <form class="forms-sample" action="{{route('saldo_item.update', $SaldoItems->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby-2', 'saldo_item')">Edit Saldo Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="kode">Pilih Items</label>
                <select class="form-control" name="items_id">
                  @foreach($Items as $item)
                    <option
                    value="{{ $item->id }}"
                    {{ $SaldoItems->items_id == $item->id ? 'selected' : '' }}
                    >
                    {{ $item->kode.' - '. $item->nama }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
                  <label for="unit">Unit</label>
                  <input type="number" class="form-control" name="unit" id="unit" v-model="unit"  >
              </div>
              <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" name="price" id="price" v-model="price" >
              </div>
              <div class="form-group">
                  <label for="total">Total</label>
                  <input type="number" class="form-control" name="total" id="total" readonly="" :value="totals">
              </div>
              <input class="form-control" type="hidden" id="yang_membayar" name="status" value="1">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="{{route('saldo_item.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-arrow-left"></i>Back</a>
        <button class="btn btn-success btn-rounded"><i class="ik ik-plus-circle"></i> Edit</button>
      </div>
    </form>

</div>
</div>
</div>
</div>

@endsection

@section('vue')
<script type="text/javascript">
  new Vue({
    el: '#app',
    data: {
      unit: '{{ $SaldoItems->unit }}',
      price: '{{ $SaldoItems->price }}',
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
