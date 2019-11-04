@extends('layouts.app')

@section('title', 'AccountMin - Create Kas Kecil')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
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
                <li class="breadcrumb-item active" aria-current="page">Kas Kecil</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row" id="app">
        <div class="col-md-12">
          <form class="forms-sample" action="{{route('kas_kecil.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-row">
                  <div class="left-container">
                    <h3>Basic form elements</h3>
                  </div>
                  <div class="right-container">
                    <a class="btn btn-outline-primary btn-rounded" href="{{ route('kas_kecil.index') }}">Back</a>
                  </div>
                </div>
                <div class="card-body">
                    <div class="row input-group-primary">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tanggal">Tanggal Transaksi</label>
                          <input class="form-control" type="date" id="tanggal" name="tanggal">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="kode">Nomor Transaksi</label>
                          <input class="form-control" type="text" id="kode" name="kode">
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
                          <label for="nomor_akun">Dari Akun</label>
                          <select class="form-control" id="nomor_akun" name="nomor_akun[]">
                            @foreach ($akun as $key)
                              <option value="{{$key->nomor}}">{{$key->nomor}} - {{$key->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="description">Deskripsi</label>
                          <input class="form-control" type="text" id="description" name="description[]" v-model="cashbank.description">
                        </div>
                      </div>
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
                        <div class="form-group">
                          <button class="btn btn-rounded btn-success" @click="add()" type="button"><i class="ik ik-plus-circle"> Tambah data</i></button>
                        </div>
                      </div>
                    </div>

                    <div style="margin-bottom: 40px;"></div>

                    <div class="row d-flex justify-content-end">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Total Debet</label>
                          <input class="form-control" type="text" name="totald" :value="totald" readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Total Kredit</label>
                          <input class="form-control" type="text" name="totalk" :value="totalk" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-outline-primary btn-rounded">Submit</button>
                      </div>
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
					{nomor_akun:"", description:"", debet: 0, kredit: 0},
				]
			},
			methods: {
				add() {
					var cashbanks = {nomor_akun:"", description:"", debet: 0, kredit: 0};
					this.cashbanks.push(cashbanks);
				},
				del(index) {
					if (index > 0) {
						this.cashbanks.splice(index, 1);
					}
				},
			},
			computed: {
        totald: function(){
          let sum = 0;
          this.cashbanks.forEach(function(cashbank) {
             sum += (parseFloat(cashbank.debet));
          });

         return sum;
        },
        totalk: function(){
          let sum = 0;
          this.cashbanks.forEach(function(cashbank) {
             sum += (parseFloat(cashbank.kredit));
          });

         return sum;
        },
			},
		});
	</script>
@endsection
