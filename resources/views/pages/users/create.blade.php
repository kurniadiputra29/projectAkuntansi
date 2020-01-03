@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'users')">Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="nomor">Nama User</label>
                  <input type="text" name="nama" class="form-control" placeholder="Nama" required="">
              </div>
              <div class="form-group">
                  <label for="nama">Email User</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required="">
              </div>
              <div class="form-group">
                  <label for="keterangan">Password User</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
              </div>
              <div class="form-group">
                  <label for="keterangan">Foto User</label>
                  <input type="file" name="foto" class="file-upload-default">
                  <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                      </span>
                  </div>
              </div>
              <div class="form-group">
                <label for="role_id">Role User</label>
                <select class="form-control" id="role_id" name="role_id">
                  <option class="col-sm-10" value=""> ~~ Pilih Role ~~ </option>
                  @foreach ($role as $key)
                  <option value="{{$key->id}}">{{$key->nama}}</option>
                  @endforeach
                </select>
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
