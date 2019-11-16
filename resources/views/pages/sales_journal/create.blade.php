@extends('layouts.app')

@section('title', 'AccountMin - Create Sales Journal')

@section('content')

<div class="main-content">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-lg-8">
          <div class="page-header-title">
            <i class="ik ik-menu bg-blue"></i>
            <div class="d-inline">
              <h5>Create Sales Journal</h5>
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
              <li class="breadcrumb-item active" aria-current="page">Sales Journal</li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <div class="row" id="app">
      <div class="col-md-12">

        <form class="forms-sample" id="a" action="{{route('cashbank.store')}}" method="post">
          @csrf
          <div class="card">
            <div class="card-header" style="background: #2dce89;"><h3 style="color: white">Sales Journal</h3>
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
                        <option value="{{$key->id}}">{{$key->nomor}} - {{$key->nama}}</option>
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
                      <select class="form-control" id="setor_ke">
                        <option value=""> ~~ Pilih Customers ~~ </option>
                        @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->nama}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input class="form-control" name="tanggal" type="date" id="tanggal_transaksi">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="no_transaksi">Nomor Transaksi</label>
                    <input class="form-control" name="kode" type="text" id="no_transaksi">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" name="description" type="text" id="description" rows="3"></textarea>
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
                    <select class="form-control" id="nomor_akun">
                      <option class="col-sm-10" value=""> ~~ Pilih Items ~~ </option>
                      @foreach ($items as $item)
                      <option value="{{$item->id}}">{{$item->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="jumlah">QTY</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah[]" v-model="cashbank.jumlah">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="jumlah">Harga Satuan</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah[]" v-model="cashbank.jumlah">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah[]" v-model="cashbank.jumlah">
                  </div>
                </div>
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

          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Sub Total : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="total[]" :value="total" readonly>
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">PPN 10% : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="total[]" :value="total">
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Jasa Pengiriman : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="total[]" :value="total">
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Total : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="exampleInputUsername2" name="total[]" :value="total" readonly>
            </div>
          </div>

          <div class="forms-sample" style="margin-bottom: 10px; margin-top: 30px; justify-content: space-between; display: flex;">
            <a href="{{route('sales_journal.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-arrow-left"></i>Back</a>
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
<script type="text/javascript">
  new Vue({
   el: '#app',
   data: {
    cashbanks: [
    {terima_dari:"", description:"", jumlah: 0},
    ],
    cashbanks2: [
    {terima_dari:"", description:"", jumlah: 0},
    ]
  },
  methods: {
    add() {
       var cashbanks = {terima_dari:"", description:"", jumlah: 0};
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
        this.cashbanks[index].nomor_akun = nomor_akun;
        return nomor_akun;
      },
      nama_akun2(id_akun2, index) {
        var nama_akun = this.nama_akuns[id_akun2];
        this.cashbanks[index].nama_akun = nama_akun;
        return nama_akun;
      },
  },
  computed: {
    total: function(){
      let sum = 0;
      this.cashbanks.forEach(function(cashbank) {
        sum += (parseFloat(cashbank.jumlah));
      });
      return sum;
    },
    nomor_akuns() {
      var akun = [];
      akun[0] = 0;
      @foreach($akun as $key)
        akun[ {{ $key->id }} ] = "{{ $key->nomor }}"
      @endforeach
      return akun;
    },
    nama_akuns() {
      var akun = [];
      akun[0] = 0;
      @foreach($akun as $key)
        akun[ {{ $key->id }} ] = "{{ $key->nama }}"
      @endforeach
      return akun;
    },
  },
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#sembunyikan").click(function(){
      $("#a").show();
      $("#b").hide();
    });
    $("#muncul").click(function(){
      $("#a").hide();
      $("#b").show();
    });
  });
</script>
@endsection