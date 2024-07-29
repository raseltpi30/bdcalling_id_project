<form action="{{route('subcategory.update')}}" method="post"> 
    @csrf
    <input type="hidden" name="id" value="{{$subcategory->id}}">
    <div class="modal-content">
      <div class="modal-body">
          <div class="form-group row">
            <label for="select" class="col-sm-4 col-form-label text-right">Category Name *</label> 
            <div class="col-sm-8">
              <select class="form-control" name="category_id">       
                @foreach ($categories as $item)
                    <option value="{{$item->id}}" @if ($subcategory->category_id == $item->id) selected="" @endif>{{$item->category_name}}</option>                          
                @endforeach
  
              </select>
            </div>
          </div>
          <div class="form-group row">
              <label for="subcategory_name" class="col-sm-4 col-form-label text-right"> subcategory Name *</label>
              <div class="col-sm-8">
                <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="SubCategory Name" value="{{$subcategory->subcategory_name}}">
              </div>
          </div>
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update subcategory</button>	
      </div>
    </div>
  </form>