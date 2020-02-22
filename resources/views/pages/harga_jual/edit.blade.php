@extends('layouts.app')

@section('title', 'AccountMin - Harga Jual Produk')

@section('content')

<div class="main-content">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-lg-8">
          <div class="page-header-title">
            <i class="ik ik-clipboard bg-blue"></i>
            <div class="d-inline">
              <h5>Harga Jual Produk</h5>
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
                <a href="/retur_pembelian">Harga Jual Produk</a>
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
        <form class="forms-sample" action="{{route('harga_jual.update', $HargaJuals->id)}}" method="post">
        @csrf
        @method('PUT')
          <div class="card">
            <div class="card-header" style="background: #2dce89;"><h3 style="color: white">Harga Jual Produk</h3>
            </div>
            <div class="card-body">
              <div
                v-for="(cashbank, index) in cashbanks"
                :key="index"
              >
                <div class="form-group">
                  <label for="items_id">Items</label>
                  <select class="form-control" id="items_id" v-model="cashbank.items_id" name="items_id">
                    <option class="col-sm-10" value="0"> ~~ Pilih Items ~~ </option>
                    @foreach ($items as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="harga">Harga Satuan</label>
                  <input class="form-control" type="text" id="harga" name="hpp" :value="harga(cashbank.items_id, index)" readonly>
                </div>
              </div>
              <div class="form-group">
                  <label for="harga_jual">Harga Jual</label>
                  <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="{{ $HargaJuals->harga_jual }}">
              </div>
              <div class="forms-sample" style="margin-bottom: 10px; margin-top: 30px; justify-content: space-between; display: flex;">
                <a href="{{route('harga_jual.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-arrow-left"></i>Back</a>
                <button class="btn btn-success btn-rounded"><i class="ik ik-plus-circle"></i> Create</button>
              </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>

@endsection

@section('vue')
<!-- <script>
  $(document).ready(function() {
    const genderOldValue = '{{ old('items_id') }}';
    
    if(genderOldValue !== '') {
      $('#items_id').val(genderOldValue);
    }
  });
</script> -->
<script type="text/javascript">
  new Vue({
   el: '#app',
   data: {
    cashbanks: [
    {items_id:'{{ $HargaJuals->items_id }}', harga:0},
    ],
  },
  methods: {
    harga(items_id, index) {
      var nama_akun = this.items[items_id];
      this.cashbanks[index].nama_akun = nama_akun;
      return nama_akun;
    },
  },
  computed: {
    items() {
      var items = [];
      items[0] = 0;
      @foreach($items as $key)
        items[ {{ $key->id }} ] = '{{$inventories->where('items_id',$key->id)->sum('total') / $inventories->where('items_id',$key->id)->sum('unit')}}'
      @endforeach
      return items;
    },
  },
});
</script>
@endsection
