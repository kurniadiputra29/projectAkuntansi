@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('saldo_hutang.store')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'saldo_hutang')">Tambah Saldo Awal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Pilih Supplier</label>
                  <select class="form-control" name="suppliers_id">
                    @foreach ($dataSupplier as $key)
                      <option value="{{$key->id}}">{{$key->kode.' - '.$key->nama}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" id="keterangan">
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
