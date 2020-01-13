@extends('layouts.create-modal')

@section('create-modal-content')
  {{-- actually in this case digunakan sebagai form pemfilter --}}
  <div class="modal-content">
    <form class="forms-sample" action="{{route('daftar_pembelian.filter')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'filter_pc')">Filter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="filter">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tanggal_mulai" id="filter">
              </div>
              <div class="form-group">
                <label for="filter2">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tanggal_akhir" id="filter2">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary mr-2">Filter</button>
        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
@endsection
