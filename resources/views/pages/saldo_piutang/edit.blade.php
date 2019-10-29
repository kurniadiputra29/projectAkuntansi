<div class="modal fade" id="editModal_{{ $key->id }}" tabindex="-1" role="dialog" aria-labelledby="@yield('aria-labelledby-2')" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">  <div class="modal-content">
      <form class="forms-sample" action="{{route('saldo_piutang.update', $key->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby-2', 'saldo_awal')">Edit Saldo Awal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="kode">Pilih Customer</label>
                <select class="form-control" name="customers_id">
                  @foreach($dataCustomer as $item)
                    <option
                    value="{{ $item->id }}"
                    {{ $key->customer_id == $item->id ? 'selected' : '' }}
                    >
                    {{ $item->kode.' - '. $item->nama }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input type="number" class="form-control" name="keterangan" id="keterangan" value="{{ $key->keterangan }}">
            </div>
            <div class="form-group">
              <label for="debet">Debet</label>
              <input type="number" class="form-control" name="debet" id="debet" value="{{ $key->debet }}">
            </div>
            <div class="form-group">
              <label for="kredit">Kredit</label>
              <input type="number" class="form-control" name="kredit" id="kredit" value="{{ $key->kredit }}">
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
