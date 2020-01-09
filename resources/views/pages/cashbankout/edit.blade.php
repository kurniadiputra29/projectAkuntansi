@extends('layouts.app')

@section('title', 'AccountMin - Edit Cash & Bank Out')

@section('content')

<div class="main-content">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row align-items-end">
        <div class="col-lg-8">
          <div class="page-header-title">
            <i class="ik ik-menu bg-blue"></i>
            <div class="d-inline">
              <h5>Edit Cash & Bank</h5>
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
        <form class="forms-sample" id="b" action="{{route('cashbank_out.update', $cashbanks->id)}}" method="post">
          @csrf
          @method('PUT')
          <div class="card">
            <div class="card-header" style="background: #fb6340;"><h3 style="color: white">Pengeluaran Cash & Bank</h3>
            </div>
            <div class="card-body">

              <div
                v-for="(cashbank, index) in cashbanks2"
                :key="index"
                >
                <div class="row input-group-primary">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="setor_ke">Di Bayar Dari</label>
                      <select class="form-control" id="setor_ke" v-model="cashbank.id_akun2">
                        @foreach($kredits as $kredit)
                        @foreach ($akun as $key)
                        <option value="{{$key->nomor}}" {{$kredit->nomor_akun == $key->nomor ? 'selected' : ''}}>{{$key->nomor}} - {{$key->nama}}</option>
                        @endforeach
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
                    <label for="setor_ke">Suppliers</label>
                      <select class="form-control" id="setor_ke" name="suppliers_id">
                        <option value="0"> ~~ Pilih Suppliers ~~ </option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{$supplier->id}}" {{$cashbanks->suppliers_id == $supplier->id ? 'selected' : ''}}>{{$supplier->nama}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <input class="form-control" type="hidden" id="yang_membayar" name="status" value="1">
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
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nomor_akun">Akun</label>
                    <select class="form-control" id="nomor_akun" v-model="cashbank.id_akun">
                      <option class="col-sm-10" value=""> ~~ Pilih Akun ~~ </option>
                      @foreach ($akun as $key)
                      <option value="{{$key->nomor}}">{{$key->nomor}} - {{$key->nama}}</option>
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah[]" v-model="cashbank.jumlah">
                    <!-- <input class="form-control" type="text" id="yang_membayar" name="index" :value=" index + 1"> -->
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
            <a href="{{route('cashbank_out.index')}}" class="btn btn-secondary btn-rounded"><i class="ik ik-arrow-left"></i>Back</a>
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
    cashbanks: [
    {terima_dari:"", description:"", jumlah: 0},
    ],
    cashbanks2: [
    {id_akun2:"{{$kredit->nomor_akun}}", description:"", jumlah: 0},
    ],
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
        this.cashbanks2[index].nomor_akun = nomor_akun;
        return nomor_akun;
      },
      nama_akun2(id_akun2, index) {
        var nama_akun = this.nama_akuns[id_akun2];
        this.cashbanks2[index].nama_akun = nama_akun;
        return nama_akun;
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
    total: function(){
      let sum = 0;
      this.cashbanks.forEach(function(cashbank) {
        sum += (parseFloat(cashbank.jumlah));
      });
      return sum;
    },
  },
  created(){
    var cashbanks = [];

    @foreach($cashbanks->CashBankOutDetails as $index => $detail)
    cashbanks [{{$index-1}}] = {
      id_akun: "{{$detail->nomor_akun}}",
      nomor_akun: "{{$detail->nomor_akun}}",
      nama_akun: "{{$detail->nama_akun}}",
      jumlah: "{{$detail->debet}}",
    };
    @endforeach
    this.cashbanks = cashbanks;
  },
});
</script>
@endsection
