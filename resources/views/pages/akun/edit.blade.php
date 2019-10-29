@extends('layouts.edit-modal')

@section('edit-modal-content')

  <div class="modal-content">
    <form class="forms-sample" action="{{route('akun.update', $key->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby-2', 'edit')">Edit Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          @foreach($datas as $value)
            <div class="col-md-12">
              <div class="form-group">
                  <label for="nomor">Nomor Akun</label>
                  <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $value->nomor }}">
              </div>
              <div class="form-group">
                  <label for="nama">Nama Akun</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="{{ $value->nama }}">
              </div>
              <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $value->keterangan }}">
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>

@endsection
