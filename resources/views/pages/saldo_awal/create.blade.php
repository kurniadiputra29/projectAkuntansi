@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('saldo_awal.store')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'saldo_awal')">Tambah Saldo Awal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Pilih Akun</label>
                  <select class="form-control" name="account_id">
                    @foreach ($dataAkun as $key)
                      <option value="{{$key->id}}">{{$key->nama}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input class="form-control" name="tanggal" type="date" id="tanggal_transaksi" value="{{date("Y-m-d")}}" >
              </div>
              <div class="form-group">
                  <label for="debet">Debet</label>
                  <input type="number" class="form-control" name="debet" id="debet">
              </div>
              <div class="form-group">
                  <label for="kredit">Kredit</label>
                  <input type="number" class="form-control" name="kredit" id="kredit">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>

@endsection
