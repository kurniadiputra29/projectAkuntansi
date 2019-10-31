<div class="modal fade" id="editModal_{{ $key->id }}" tabindex="-1" role="dialog" aria-labelledby="@yield('aria-labelledby-2')" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
                  <label for="unit">Banyak Unit</label>
                  <input type="number" class="form-control" name="unit" id="unit" value="{{ $key->unit }}">
              </div>
              <div class="form-group">
                  <label for="harga">Harga per Unit</label>
                  <input type="number" class="form-control" name="harga" id="harga" value="{{ $key->harga }}">
              </div>
              <div class="form-group">
                  <label for="nilai_persediaan">Nilai Persediaan</label>
                  <input type="number" class="form-control" name="nilai_persediaan" id="nilai_persediaan" value="{{ $key->nilai_persediaan }}">
              </div>
              <div class="form-group">
                  <label for="gambar">Foto Item</label>
                  <input type="file" name="gambar" class="file-upload-default">
                  <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                      <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                      </span>
                  </div>
                  <img width="150px" src="{{Storage::url($key->gambar)}}" style="border: 2px solid grey; padding: 10px; margin-bottom: 20px;">
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
