@extends('layouts.create-modal')

@section('create-modal-content')  
  <div class="modal-content" id="dwc">
      <form class="forms-sample" action="{{route('saldo_item.store')}}" method="post">
      @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="@section('area-labelledby', 'saldo_item')">Tambah Saldo Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Pilih Items</label>
                  <select class="form-control" name="items_id">
                    @foreach ($Items as $key)
                      <option value="{{$key->id}}">{{$key->nama}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="unit">Unit</label>
                  <input type="text" class="form-control" name="unit" id="unit" v-model="unit">
              </div>
              <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" name="price" id="price" v-model="price">
              </div>
              <div class="form-group">
                  <label for="total">Total</label>
                  <input type="text" class="form-control" name="total" id="total" readonly="" :value="totals">
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



