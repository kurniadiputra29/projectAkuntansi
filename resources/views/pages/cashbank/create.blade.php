@extends('layouts.app')

@section('title', 'AccountMin - Create CashBank?')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-menu bg-blue"></i>
              <div class="d-inline">
                <h5>Create Cash & Bank</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Cash & Bank</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row" id="app">
        <div class="col-md-12">
          <form class="forms-sample" action="{{route('cashbank.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header"><h3>Basic form elements</h3></div>
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
                          <label for="yang_membayar">Yang Membayar</label>
                          <input class="form-control" type="text" id="yang_membayar">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="tanggal_transaksi">Tanggal Transaksi</label>
                          <input class="form-control" type="date" id="tanggal_transaksi">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="no_transaksi">Nomor Transaksi</label>
                          <input class="form-control" type="text" id="no_transaksi">
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
                          <label for="terima_dari">Terima Dari</label>
                          <input class="form-control" type="text" id="terima_dari" name="terima_dari[]" v-model="cashbank.terima_dari">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="description">Deskripsi</label>
                          <input class="form-control" type="text" id="description" name="description[]" v-model="cashbank.description">
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
                        <div class="form-group">
                          <button class="btn btn-rounded btn-success" @click="add()" type="button"><i class="ik ik-plus-circle"></i></button>
                        </div>
                      </div>
                    </div>

                    {{-- <div class="card">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Terima Dari</th>
                              <th>Deskripsi</th>
                              <th>Jumlah</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(cashbank, index) in cashbanks"
                              :key="index"
                            >
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="terima_dari" name="terima_dari" v-model="cashbank.terima_dari">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="description" name="description" v-model="cashbank.description">
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <input class="form-control" type="text" id="jumlah" name="jumlah" v-model="cashbank.jumlah">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div> --}}

                    <div style="margin-bottom: 40px;"></div>

                    <div class="row d-flex justify-content-end">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Total : Rp</label>
                          <input class="form-control" type="number" name="total" :value="total" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                      <div class="col-md-4">
                        <a class="btn btn-outline-primary btn-rounded" href="{{ route('cashbank.create') }}">Create</a>
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
			},
			computed: {
        total: function(){
          let sum = 0;
          this.cashbanks.forEach(function(cashbank) {
             sum += (parseFloat(cashbank.jumlah));
          });

         return sum;
        },
			},
		});
	</script>
@endsection
