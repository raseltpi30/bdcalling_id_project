<form action="{{route('PropertyType.update')}}" method="Post" enctype="multipart/form-data">
  @csrf
    <div class="modal-body">
      <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
          <label for="name">Name :</label>
          <input type="text" value="{{$data->name}}" id="name" class="form-control"  name="name" required="" placeholder="Brand Name" value="">
          <small id="emailHelp" class="form-text text-muted">Property size here</small>
        </div>   
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update PropertySize</button>
    </div>
  </form>