@extends('layouts.app')

@section('title', 'AccountMin - Create Cash & Bank Out')

@section('content')

<div class="main-content">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-lg-8">
          <div class="page-header-title">
            <i class="ik ik-menu bg-blue"></i>
            <div class="d-inline">
              <h5>Create Cash & Bank Out</h5>
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
                <a href="/cashbank_out">Cash & Bank Out</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
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
    <form class="forms-sample" id="b" action="{{route('cashbank_out.store')}}" method="post">
          @csrf
          <div class="card">
            <div class="card-header" style="background: #fb6340;"><h3 style="color: white">Pengeluaran Cash & Bank</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dibayar_ke">Dibayar Ke</label>
                    <textarea class="form-control" name="dibayar_ke" type="text" id="dibayar_ke" rows="2"></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input class="form-control" name="tanggal" type="date" id="tanggal_transaksi" value="{{date("Y-m-d")}}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="no_transaksi">Nomor Transaksi</label>
                    @php
                      if ( ! $lastOrder ) {
                        // We get here if there is no order at all
                        // If there is no number set it to 0, which will be 1 at the end.
                        $number = 0;
                      } else {
                        $number = $lastOrder->id;
                      }
                      $hasil = sprintf('%06d', intval($number) + 1);
                    @endphp
                    <input class="form-control" type="text" name="kode" id="no_transaksi" value="CBO-{{$hasil}}" readonly>
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
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nomor_akun">Akun</label>
                    <select class="form-control" id="nomor_akun" v-model="cashbank.id_akun">
                      <option class="col-sm-10" value=""> ~~ Pilih Akun ~~ </option>
                      @foreach ($akun as $key)
                      <option value="{{$key->id}}">{{$key->nomor}} - {{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <input type="hidden" name="nomor_akun[]"
                    :value="nomor_akun(cashbank.id_akun, index)"
                  >
                  <input type="hidden" name="nama_akun[]"
                    :value="nama_akun(cashbank.id_akun, index)"
                >
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="debet">Debet</label>
                    <input class="form-control" type="number" id="debet" name="debet[]" v-model="cashbank.debet">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="kredit">Kredit</label>
                    <input class="form-control" type="number" id="kredit" name="kredit[]" v-model="cashbank.kredit">
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
            <label for="totaldebet" class="col-sm-2 col-form-label">Total Debet: Rp</label>
            <div class="col-sm-4">
              <input class="form-control" type="number" id="totaldebet" name="totaldebet[]" :value="totaldebet" readonly>
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="totalkredit" class="col-sm-2 col-form-label">Total Kredit: Rp</label>
            <div class="col-sm-4">
              <input class="form-control" type="number" id="totalkredit" name="totalkredit[]" :value="totalkredit" readonly>
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <label for="selisih" class="col-sm-2 col-form-label">Selisih : Rp</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="selisih" name="selisih[]" :value="selisih" readonly style="color: red">
            </div>
          </div>

          <div class="forms-sample" style="margin-bottom: 10px; margin-top: 10px; justify-content: space-between; display: flex;">
            <a href="{{route('cashbank_out.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-arrow-left"></i>Back</a>
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
    {id_akun:"1", debet: 0, kredit: 0},
    ],
  },
  methods: {
    add() {
       var cashbanks = {id_akun:"1", debet: 0, kredit: 0};
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
  },
  computed: {
    totaldebet: function(){
      let sum = 0;
      this.cashbanks.forEach(function(cashbank) {
        sum += (parseFloat(cashbank.debet));
      });
      return sum;
    },
    totalkredit: function(){
      let sum = 0;
      this.cashbanks.forEach(function(cashbank) {
        sum += (parseFloat(cashbank.kredit));
      });
      return sum;
    },
    selisih: function(){
      var selisih = this.totaldebet - this.totalkredit;
      return selisih;
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
@endsection
