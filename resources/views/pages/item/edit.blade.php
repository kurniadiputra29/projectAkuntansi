<div class="modal fade" id="editModal_{{ $key->id }}" tabindex="-1" role="dialog" aria-labelledby="@yield('aria-labelledby-2')" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="forms-sample" action="{{route('item.update', $key->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby-2', 'edit')">Edit Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="kode">Kode Item</label>
                  <input type="text" class="form-control" name="kode" id="kode" value="{{ $key->kode }}">
              </div>
              <div class="form-group">
                  <label for="nama">Nama Item</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="{{ $key->nama }}">
              </div>
              <div class="form-group">
                  <label for="gambar">Foto Item</label>
                  <input type="file" name="foto" class="file-upload-default">
                  <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                      </span>
                  </div>
                  <img width="150px" height="150px" src="{{Storage::url($key->foto)}}" style="border: 2px solid grey; padding: 10px; margin-bottom: 20px;">
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
  </div>
</div>
