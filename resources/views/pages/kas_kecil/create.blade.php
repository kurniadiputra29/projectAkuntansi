@extends('layouts.app')

@section('title', 'AccountMin - Create Kas Kecil')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-briefcase bg-blue"></i>
              <div class="d-inline">
                <h5>Create Kas Kecil</h5>
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
              <div class="card-header d-flex justify-content-between flex-row bg-success">
                <div class="left-container">
                  <h3 style="color: white">Pengeluaran Pettycash</h3>
                </div>
              </div>
              <div class="card-body">

                <div class="row" v-for="(pettycash, index) in pettycashs2" :key="index">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="setor_ke">Di Bayar Dari</label>
                      <select class="form-control" id="id_akun" name="akun_id[]" v-model="pettycash.id_akun2">
                        @foreach ($akun as $key)
                          <option value="{{$key->id}}">{{$key->nomor}} - {{$key->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <input type="hidden" name="nomor_akun2[]"
                  :value="nomor_akun(pettycash.id_akun2, index)"
                  >
                  <input type="hidden" name="nama_akun2[]"
                  :value="nama_akun(pettycash.id_akun2, index)"
                  >
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="yang_membayar">Penerima</label>
                      <input class="form-control" type="text" id="yang_membayar" name="penerima" required="">
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
                      <input class="form-control" type="text" name="kode" id="no_transaksi" value="PC-{{$hasil}}" readonly>
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
                v-for="(pettycash, index) in pettycashs"
                :key="index"
                >
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="id_akun">Akun</label>
                    <select class="form-control" id="id_akun" name="id_akun[]" v-model="pettycash.id_akun">
                      <option class="col-sm-10" value=""> ~~ Pilih Akun ~~ </option>
                      @foreach ($akun as $key)
                        <option value="{{$key->id}}">{{$key->nomor}} - {{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <input type="hidden" name="nomor_akun[]"
                :value="nomor_akun(pettycash.id_akun, index)"
                >
                <input type="hidden" name="nama_akun[]"
                :value="nama_akun(pettycash.id_akun, index)"
                >
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input class="form-control uang" type="number" id="jumlah" name="jumlah[]" v-model="pettycash.jumlah">
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
                    <input class="form-control" type="number" name="total[]" :value="total" readonly>
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
        {id_akun: "", nomor_akun:"", nama_akun:"", description:"", jumlah: 0},
      ],
      pettycashs2: [
        {id_akun2:"{{$pemetaan_akuns->kas_kecil}}", description:"", jumlah: 0},
      ],
    },
    methods: {
      add() {
        var pettycashs = {id_akun: 0, nomor_akun:"", nama_akun:"", description:"", jumlah: 0};
        this.pettycashs.push(pettycashs);
      },
      del(index) {
        if (index > 0) {
          this.pettycashs.splice(index, 1);
        }
      },
      nomor_akun(id_akun, index) {
        var nomor_akun = this.nomor_akuns[id_akun];
        this.pettycashs[index].nomor_akun = nomor_akun;
        return nomor_akun;
      },
      nama_akun(id_akun, index) {
        var nama_akun = this.nama_akuns[id_akun];
        this.pettycashs[index].nama_akun = nama_akun;
        return nama_akun;
      },
      nomor_akun2(id_akun2, index) {
        var nomor_akun = this.nomor_akuns[id_akun2];
        this.pettycashs2[index].nomor_akun = nomor_akun;
        return nomor_akun;
      },
      nama_akun2(id_akun2, index) {
        var nama_akun = this.nama_akuns[id_akun2];
        this.pettycashs2[index].nama_akun = nama_akun;
        return nama_akun;
      },
    },
    computed: {
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

@endsection
