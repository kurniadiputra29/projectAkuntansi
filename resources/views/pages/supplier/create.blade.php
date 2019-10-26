@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('supplier.store')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'supplier')">Tambah Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="kode">Kode Supplier</label>
                  <input type="text" class="form-control" name="kode" id="kode" placeholder="S-XXXXX">
              </div>
              <div class="form-group">
                  <label for="nama">Nama Supplier</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Supplier">
              </div>
              <div class="form-group">
                  <label for="npwp">NPWP</label>
                  <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Masukkan 15 digit NPWP">
              </div>
              <div class="form-group">
                  <label for="alamat">Alamat Supplier</label>
                  <input type="text" class="form-control" name="alamat" id="alamat">
              </div>
              <div class="form-group">
                  <label for="termin">Termin</label>
                  <input type="text" class="form-control" name="termin" id="termin" placeholder="x x/x">
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
