@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('profile.store')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'akun')">Tambah Data Perusahaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="name">Nama Perusahaan</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Nama Perusahaan" required="">
              </div>
              <div class="form-group">
                  <label for="alamat">Alamat Perusahaan</label>
                  <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Perusahaan" required="">
              </div>
              <div class="form-group">
                  <label for="telepon">Telepon Perusahaan</label>
                  <input type="text" id="telepon" name="telepon" class="form-control" placeholder="Telepon Perusahaan" required="">
              </div>
              <div class="form-group">
                  <label for="exampleTextarea1">Deskripsi</label>
                  <textarea class="form-control" id="exampleTextarea1" name="discription" rows="2"></textarea>
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
