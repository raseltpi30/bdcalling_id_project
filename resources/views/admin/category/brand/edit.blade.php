<form action="{{ route('brand.update') }}" method="Post" id="add-form" enctype="multipart/form-data">
  @csrf
  <div class="modal-body">
    <input type="hidden" name="id" value="{{$blog->id}}">
      <div class="form-group">
        <label for="brand_name">Brand Name</label>
        <input type="text" id="brand_name" class="form-control"  name="brand_name" required="" placeholder="Brand Name" value="{{ $data->brand_name }}">
        <small id="emailHelp" class="form-text text-muted">This is your Brand Name</small>
      </div>   
      <input type="hidden" name="id" value="{{ $data->id }}">
      <div class="form-group">
        <label for="brand_logo">Brand Logo</label>
        <input type="file" id="brand_logo" class="form-control"  name="brand_logo" placeholder="Brand Logo">
        <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">
        <div class="preview">
          <img style="" src="{{asset('files/brand/'.$data->brand_logo)}}" alt="{{$data->brand_name}}">
        </div>
        <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
        
      </div>   
  </div>
  <div class="modal-footer">
    <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Submit</button>
  </div>
  </form>