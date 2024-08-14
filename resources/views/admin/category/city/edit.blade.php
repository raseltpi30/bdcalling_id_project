<form action="{{route('city.update')}}" method="Post">
  @csrf
    <div class="modal-body">
      <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label text-right">Name *</label>
            <div class="col-sm-8">
              <input type="text" name="name" id="name" value="{{$data->city_name}}" class="form-control" placeholder="Name">
              <small id="emailHelp"  class="form-text text-muted">This is your Name</small>                  
            </div>
        </div>
        <div class="form-group row">
          <label for="category_id" class="col-sm-4 col-form-label text-right">Country Name *</label> 
          <div class="col-sm-8">
            <select class="form-control" name="country_id" required="">
              @foreach ($country as $cat)
                <option value="{{$cat->id}}" @if ($data->country_id == $cat->id) selected="" @endif>{{$cat->name}}</option>                            
              @endforeach
            </select>
            <small id="emailHelp" class="form-text text-muted">This is your Category Name</small>
          </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add New City</button>
    </div>
</form>