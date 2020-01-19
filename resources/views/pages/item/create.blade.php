@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'item')">Tambah Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="kode">Kode Item</label>
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
                  <input type="text" class="form-control" name="kode" id="kode" value="AU-N{{$hasil}}" readonly>
              </div>
              <div class="form-group">
                  <label for="nama">Nama Item</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Item">
              </div>
              <div class="form-group">
                  <label for="gambar">Foto Item</label>
                  <input type="file" name="foto" class="file-upload-default">
                  <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" placeholder="Upload Image">
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                      </span>
                  </div>
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
