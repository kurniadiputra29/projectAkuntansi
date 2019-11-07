@extends('layouts.app')

@section('title', 'AccountMin - Create Pettycash')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
              <div class="d-inline">
                <h5>Create Pettycash</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Pettycash</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row" id="app">
        <div class="col-md-12">
          <form class="forms-sample" id="a" action="{{route('kas_kecil.store')}}" method="post">
            @csrf
            <div class="card">
              <div class="card-header" style="background: #fb6340;"><h3 style="color: white">Pengeluaran Pettycash</h3>
              </div>
              <div class="card-body">
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
                      <label for="yang_membayar">Diterima Dari</label>
                      <input class="form-control" type="text" id="yang_membayar" disabled>
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
                      <textarea class="form-control" name="diskription" type="text" id="description" rows="3"></textarea>
                    </div>
                  </div>
                </div>

                <div
                class="row"
                v-for="(pettycash, index) in pettycashs"
                :key="index"
                >
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nomor_akun">Akun</label>
                    <select class="form-control" id="nomor_akun" name="nomor_akun[]">
                      <option class="col-sm-10" value=""> ~~ Pilih Akun ~~ </option>
                      @foreach ($akun as $key)
                        <option>{{$key->nomor}} - {{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah[]" v-model="pettycash.jumlah">
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

              <div class="row d-flex justify-content-end">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Total : Rp</label>
                    <input class="form-control" type="number" name="total" :value="total" readonly>
                  </div>
                </div>
              </div>

              <div class="forms-sample" style="margin-bottom: 10px; margin-top: 10px; justify-content: space-between; display: flex;">
                <a class="btn btn-secondary btn-rounded" href="/kas_kecil"><i class="ik ik-arrow-left"></i> Back</a>
                <button class="btn btn-success btn-rounded" type="submit"><i class="ik ik-plus-circle"></i> Create</button>
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
    pettycashs: [
    {terima_dari:"", description:"", jumlah: 0},
    ]
  },
  methods: {
    add() {
     var pettycashs = {terima_dari:"", description:"", jumlah: 0};
     this.pettycashs.push(pettycashs);
   },
   del(index) {
     if (index > 0) {
      this.pettycashs.splice(index, 1);
    }
  },
},
computed: {
  total: function(){
    let sum = 0;
    this.pettycashs.forEach(function(pettycash) {
     sum += (parseFloat(pettycash.jumlah));
   });
    return sum;
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
