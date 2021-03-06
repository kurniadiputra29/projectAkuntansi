@extends('layouts.app')

@section('title', 'AccountMin - Edit Retur Penjualan')

@section('content')

<div class="main-content">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-lg-8">
          <div class="page-header-title">
            <i class="ik ik-package bg-blue"></i>
            <div class="d-inline">
              <h5>Edit Retur Penjualan</h5>
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
              <li class="breadcrumb-item active" aria-current="page">Retur Penjualan</li>
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
        <form class="forms-sample" action="{{route('retur_penjualan.update', $cashbanks->id)}}" method="post">
          @csrf
          @method('PUT')
          <div class="card">
            <div class="card-header" style="background: #2dce89;"><h3 style="color: white">Retur Penjualan</h3>
            </div>
            <div class="card-body">
              <div
                v-for="(cashbank, index) in cashbanks2"
                :key="index"
                >
                <div class="row input-group-primary">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="setor_ke">Setor Ke</label>
                      <select class="form-control" id="setor_ke" v-model="cashbank.id_akun2">
                        @foreach ($akun as $key)
                        <option value="{{$key->nomor}}" {{$kredits->nomor_akun == $key->nomor ? 'selected' : ''}}>{{$key->nomor}} - {{$key->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="nomor_akun2[]"
                    :value="nomor_akun(cashbank.id_akun2, index)"
                  >
                <input type="hidden" name="nama_akun2[]"
                    :value="nama_akun(cashbank.id_akun2, index)"
                >
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="setor_ke">Customers</label>
                      <select class="form-control" id="setor_ke" name="customers_id">
                        <option value="0"> ~~ Pilih Customers ~~ </option>
                        @foreach ($customers as $customer)
                        <option value="{{$customer->id}}" {{$cashbanks->customers_id == $customer->id ? 'selected' : ''}}>{{$customer->nama}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <input class="form-control" name="crj_id" type="hidden" value="{{$cashbanks->crj_id}}">
                <input class="form-control" name="salesjournal_id" type="hidden" value="{{$cashbanks->salesjournal_id}}">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input class="form-control" name="tanggal" type="date" id="tanggal_transaksi" value="{{$cashbanks->tanggal}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="no_transaksi">Nomor Transaksi</label>
                    <input class="form-control" name="kode" type="text" id="no_transaksi" value="{{$cashbanks->kode}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" name="description" type="text" id="description" rows="3">{{$cashbanks->description}}</textarea>
                  </div>
                </div>
              </div>

              <div
                class="row"
                v-for="(cashbank, index) in cashbanks"
                :key="index"
              >
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="nomor_akun">Items</label>
                    <select class="form-control" id="nomor_akun" v-model="cashbank.id_item" name="items[]">
                      <option class="col-sm-10" value=""> ~~ Pilih Items ~~ </option>
                      @foreach ($items as $item)
                      <option value="{{$item->id}}">{{$item->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="unit">QTY</label>
                    <input class="form-control" type="number" id="unit" name="unit[]" v-model="cashbank.unit">
                    <input class="form-control" type="hidden" id="yang_membayar" name="status[]" value="1">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="harga">Harga Pokok Penjualan</label>
                    <input class="form-control" type="number" id="harga" name="harga[]" :value="harga(cashbank.id_item, index)" readonly="">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="harga_jual">Harga Penjualan</label>
                    <input class="form-control" type="text" id="harga_jual" name="harga_jual[]" :value="harga_jual(cashbank.id_item, index)">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah[]" :value="jumlah(cashbank.id_item, cashbank.unit, cashbank.harga_jual, index)" readonly="">
                  </div>
                </div>
                <input class="form-control" type="hidden" name="sales[]" :value="sales(cashbank.id_item, cashbank.unit, cashbank.harga_jual, index)" readonly="">
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="jumlah">Delete</label>
                    <button class="btn btn-rounded btn-danger" @click="del(index)" type="button"><i class="ik ik-delete"></i></button>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group" style="justify-content: center; display: flex;">
                  <button class="btn btn-rounded btn-success" @click="add()" type="button"><i class="ik ik-plus-circle"></i>Tambah Akun</button>
                </div>
              </div>
            </div>
          @if ($cashbanks->crj_id == null)
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Sub Total : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="subtotal[]" :value="subtotal" readonly>
              <input type="hidden" name="nomor_akun_sales[]" value="{{$pemetaan_akuns->penjualan_credits->nomor}}">
              <input type="hidden" name="nama_akun2_sales[]" value="{{$pemetaan_akuns->penjualan_credits->nama}}">
            </div>
          </div>
            <input type="hidden" class="form-control" id="exampleInputUsername2" name="cost[]" :value="cost" readonly>
            <input type="hidden" name="nomor_akun_inventory[]" value="{{$pemetaan_akuns->inventories->nomor}}">
            <input type="hidden" name="nama_akun2_inventory[]" value="{{$pemetaan_akuns->inventories->nama}}">
            <input type="hidden" name="nomor_akun_cost[]" value="{{$pemetaan_akuns->hpp_penjualan_credits->nomor}}">
            <input type="hidden" name="nama_akun2_cost[]" value="{{$pemetaan_akuns->hpp_penjualan_credits->nama}}">
          @else
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Sub Total : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="subtotal[]" :value="subtotal" readonly>
              <input type="hidden" name="nomor_akun_sales[]" value="{{$pemetaan_akuns->penjualan_cashs->nomor}}">
              <input type="hidden" name="nama_akun2_sales[]" value="{{$pemetaan_akuns->penjualan_cashs->nama}}">
            </div>
          </div>
            <input type="hidden" class="form-control" id="exampleInputUsername2" name="cost[]" :value="cost" readonly>
            <input type="hidden" name="nomor_akun_inventory[]" value="{{$pemetaan_akuns->inventories->nomor}}">
            <input type="hidden" name="nama_akun2_inventory[]" value="{{$pemetaan_akuns->inventories->nama}}">
            <input type="hidden" name="nomor_akun_cost[]" value="{{$pemetaan_akuns->hpp_penjualan_cashs->nomor}}">
            <input type="hidden" name="nama_akun2_cost[]" value="{{$pemetaan_akuns->hpp_penjualan_cashs->nama}}">
          @endif
          <div class="form-group row justify-content-end" >
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">PPN 10% : Rp</label>
            <div class="col-sm-4">
              <div class="checkbox-color checkbox-primary">
                  <input id="checkbox18" type="checkbox" value="PPN" v-model="ppn">
                  <label for="checkbox18">
                  PPN 10%
                  </label>
                  <input type="hidden" name="nomor_akun_ppn[]" value="{{$pemetaan_akuns->ppn_penjualans->nomor}}">
                  <input type="hidden" name="nama_akun2_ppn[]" value="{{$pemetaan_akuns->ppn_penjualans->nama}}">
                  <input type="hidden" class="form-control" id="exampleInputUsername2" name="PPN[]" :value="ppns"  readonly>
              </div>
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Jasa Pengiriman : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="jasa_pengiriman[]" v-model.number="jasa_pengiriman">
              <input type="hidden" name="nomor_akun_jasa[]" value="{{$pemetaan_akuns->pengiriman_penjualans->nomor}}">
              <input type="hidden" name="nama_akun2_jasa[]" value="{{$pemetaan_akuns->pengiriman_penjualans->nama}}">
            </div>
          </div>
          @if($cashbanks->crj_id !== null)
          <div class="form-group row justify-content-end">
            <label for="diskon" class="col-sm-2 col-form-label">Diskon Penjualan : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="diskon" name="diskon[]" v-model.number="diskon">
              <input type="hidden" name="nomor_akun_diskon[]" value="{{$pemetaan_akuns->diskon_penjualans->nomor}}">
              <input type="hidden" name="nama_akun2_diskon[]" value="{{$pemetaan_akuns->diskon_penjualans->nama}}">
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Total : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="total[]" :value="totalss"  readonly>
            </div>
          </div>
          @else
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Total : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="total[]" :value="totals"  readonly>
            </div>
          </div>
          @endif
          <div class="forms-sample" style="margin-bottom: 10px; margin-top: 30px; justify-content: space-between; display: flex;">
            <a href="{{route('retur_penjualan.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-arrow-left"></i>Back</a>
            <button class="btn btn-success btn-rounded"><i class="ik ik-plus-circle"></i> Edit</button>
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
<script type="text/javascript">
  new Vue({
   el: '#app',
   data: {
    cashbanks2: [
    {id_akun2:"{{$kredits->nomor_akun}}"},
    ],
    cashbanks: [
    {id_item:0, harga:0, harga_jual:0, description:"", unit:1, jumlah: 0, sales:0},
    ],
    jasa_pengiriman: [
      {jasa_pengiriman:0, subtotal:0}
    ],
    diskon: 0,
    ppn: [],
  },
  methods: {
    add() {
       var cashbanks = {id_item:0, harga:0, harga_jual:0, description:"", unit:1, jumlah: 0, sales:0};
       this.cashbanks.push(cashbanks);
     },
     del(index) {
       if (index > 0) {
        this.cashbanks.splice(index, 1);
      }
    },
      nomor_akun(id_akun, index) {
        var nomor_akun = this.nomor_akuns[id_akun];
        this.cashbanks[index].nomor_akun = nomor_akun;
        return nomor_akun;
      },
      nama_akun(id_akun, index) {
        var nama_akun = this.nama_akuns[id_akun];
        this.cashbanks[index].nama_akun = nama_akun;
        return nama_akun;
      },
      nomor_akun2(id_akun2, index) {
        var nomor_akun = this.nomor_akuns[id_akun2];
        this.cashbanks2[index].nomor_akun = nomor_akun;
        return nomor_akun;
      },
      nama_akun2(id_akun2, index) {
        var nama_akun = this.nama_akuns[id_akun2];
        this.cashbanks2[index].nama_akun = nama_akun;
        return nama_akun;
      },
      harga(id_item, index) {
        var nama_akun = this.items[id_item];
        this.cashbanks[index].nama_akun = nama_akun;
        return nama_akun;
      },
      harga_jual(id_item, index) {
        var nama_akun = this.harga_juals[id_item];
        this.cashbanks[index].nama_akun = nama_akun;
        return nama_akun;
      },
      jumlah(id_item, unit, harga_jual, index){
        var jumlah =  (parseInt(this.harga_juals[id_item]))*unit;
        this.cashbanks[index].jumlah = jumlah;
        return jumlah;
      }, 
      sales(id_item, unit, harga_jual, index){
        var sales =  this.items[id_item]*unit;
        this.cashbanks[index].sales = sales;
        return sales;
      },
  },
  computed: {
    nomor_akuns() {
      var akun = [];
      akun[0] = 0;
      @foreach($akun as $key)
        akun[ "{{ $key->nomor }}" ] = "{{ $key->nomor }}"
      @endforeach
      return akun;
    },
    nama_akuns() {
      var akun = [];
      akun[0] = 0;
      @foreach($akun as $key)
        akun[ "{{ $key->nomor }}" ] = "{{ $key->nama }}"
      @endforeach
      return akun;
    },
    harga_juals() {
      var harga_juals = [];
      harga_juals[0] = 0;
      @foreach($items as $key)
        @if($inventories->where('items_id',$key->id)->where('retur_penjualan_id', $cashbanks->id)->sum('total') < $Item_count)
          harga_juals[ {{ $key->id }} ] = '{{$hargajuals->where('items_id', $key->id)->sum('harga_jual')}}'
        @else
        harga_juals[ {{ $key->id }} ] = '{{$inventories->where('items_id', $key->id)->where('retur_penjualan_id', $cashbanks->id)->sum('sales')}}'
        @endif
      @endforeach
      return harga_juals;
    },
    items() {
      var items = [];
      items[0] = 0;
      @foreach($items as $key)
        @if($inventories->where('items_id',$key->id)->where('retur_penjualan_id', $cashbanks->id)->sum('total') < $Item_count)
          items[ {{ $key->id }} ] = '{{$inventoriess->where('items_id',$key->id)->sum('total') / $inventoriess->where('items_id',$key->id)->sum('unit')}}'
        @else
          items[ {{ $key->id }} ] = '{{$inventories->where('items_id',$key->id)->where('retur_penjualan_id', $cashbanks->id)->sum('total') / $inventories->where('items_id',$key->id)->where('retur_penjualan_id', $cashbanks->id)->sum('unit')}}'
        @endif
      @endforeach
      return items;
    },
    subtotal() {
      return this.cashbanks
      .map( cashbank => cashbank.jumlah)
      .reduce( (prev, next) => prev + next );
    },
    cost() {
      return this.cashbanks
      .map( cashbank => cashbank.sales)
      .reduce( (prev, next) => prev + next );
    },
    ppns() {
        if (this.ppn == '') {
          var ppns =  0;
          this.ppn = this.ppn;
          return ppns;
        } else
        var ppns = this.subtotal*10/100;
        return ppns;
      },
      jasas() {
        var jasas = this.jasa_pengiriman;
        return jasas;
      },
    totals() {
        if (this.subtotal == '') {
          var totals =  0;
          this.jasa_pengiriman = this.subtotal;
          return totals;
        } else
        var totals = this.subtotal + this.ppns + this.jasa_pengiriman;
        return totals;
      },
    totalss() {
      if (this.subtotal == '') {
        var totals =  0;
        this.jasa_pengiriman = this.subtotal;
        return totals;
      } else
      var totals = (this.subtotal + this.ppns + this.jasa_pengiriman) - this.diskon;
        return totals;
    },
  },
  created(){
    var cashbanks = [];
    @foreach($cashbanks->Inventory as $index => $detail)
    cashbanks [{{$index}}] = {
      id_item: "{{$detail->items_id}}",
      unit: "{{$detail->unit}}",
      price: "{{$detail->price}}",
      jumlah: "{{$detail->total}}",
      sales: "{{$detail->total}}",
      harga_jual: "{{$detail->sales}}",
    };
    @endforeach
    this.cashbanks = cashbanks;
    @if(isset($jasa))
      this.jasa_pengiriman = parseInt('{{ $jasa->debet }}');
    @endif

    @if(isset($diskon))
      this.diskon = parseInt('{{ $diskon->kredit }}');
    @endif

    @if(isset($ppn) && $ppn == true)
      this.ppn = true;
    @endif
  },
});
</script>
@endsection