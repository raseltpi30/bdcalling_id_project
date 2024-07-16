<form action="{{ route('warehouse.update',$data->id) }}"  method="Post" id="add-form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">
        <div class="form-group">
          <label for="warehouse_name">Warehouse Name</label>
          <input type="text" id="warehouse_name" class="form-control"  name="warehouse_name" required="" placeholder="Warehouse Name" value="{{ $data->warehouse_name }}">
          <small id="emailHelp" class="form-text text-muted">This is your Warehouse Name</small>
        </div> 
        <div class="form-group">
          <label for="warehouse_address">Warehouse Address</label>
          <textarea name="warehouse_address" required="" class="form-control" id="warehouse_address" placeholder="Warehouse Address">{{ $data->warehouse_name }}</textarea>
          <small id="emailHelp" class="form-text text-muted">This is your Warehouse Name</small>
        </div> 
        <div class="form-group">
          <label for="warehouse_phone">Warehouse Phone</label>
          <input type="text" id="warehouse_phone" class="form-control"  name="warehouse_phone" required="" placeholder="Warehouse Phone" value="{{ $data->warehouse_name }}">
          <small id="emailHelp" class="form-text text-muted">This is your Warehouse Phone</small>
        </div> 
    </div>
    <div class="modal-footer">
      <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Submit</button>
    </div>
    </form>
  </div>