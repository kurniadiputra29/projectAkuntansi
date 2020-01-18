@extends('layouts.create-modal')

@section('create-modal-content')
  <div class="modal-content">
    <form class="forms-sample" action="{{route('customer.store')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'customer')">Tambah Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="kode">Kode Customer</label>
                  @php
                    if ( ! $lastOrder ) {
                      // We get here if there is no order at all
                      // If there is no number set it to 0, which will be 1 at the end.
                      $number = 0;
                    } else {
                      $number = $lastOrder->id;
                    }
                    $hasil = sprintf('%04d', intval($number) + 1);
                  @endphp
                  <input type="text" class="form-control" name="kode" id="kode" value="C-{{$hasil}}" readonly>
              </div>
              <div class="form-group">
                  <label for="nama">Nama Customer</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Customer">
              </div>
              <div class="form-group">
                  <label for="npwp">NPWP</label>
                  <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Masukkan 15 digit NPWP">
              </div>
              <div class="form-group">
                  <label for="alamat">Alamat Customer</label>
                  <input type="text" class="form-control" name="alamat" id="alamat">
              </div>
              <div class="form-group">
                  <label for="telepon">Telepon Customer</label>
                  <input type="text" class="form-control" name="telepon" id="telepon">
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
