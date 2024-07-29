<form action="{{route('category.update',$category->id)}}" method="Post" enctype="multipart/form-data">
@csrf
  <div class="modal-content">
    <div class="modal-body">
      {{-- <input type="hidden" name="id" value="{{$category->id}}"> --}}
        <div class="form-group row">
            <label for="category_name" class="col-sm-4 col-form-label text-right"> Category Name *</label>
            <div class="col-sm-8">
              <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" value="{{$category->category_name}}">
              @error('category_name')
              <div class="alert alert-danger p-1" style="font-size:14px">
                  {{ $message }}
              </div>
              @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="category_icon" class="col-sm-4 col-form-label text-right"> Category Icon *</label>
            <div class="col-sm-8">
              <input type="file" name="category_icon" class="dropify" id="category_icon">
              <input type="hidden" name="old_icon" value="{{ $category->category_icon }}">
              <div class="preview">
                <small>old icon</small>
                <img style="height:30px;width:30px;" src="{{asset('files/category/'.$category->category_icon)}}" alt="">
              </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="homepage" class="col-sm-4 col-form-label text-right"> Homepage *</label>
            <div class="col-sm-8">
              <input type="checkbox" name="homepage" value="1" @if($category->homepage == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                @error('homepage')
                  <div class="alert alert-danger p-1" style="font-size:14px">
                      {{ $message }}
                  </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Category</button>
    </div>
  </div>
</form>
<script src="{{asset('backend')}}/custom/product/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> 
<script type="text/javascript">
  $('.dropify').dropify();  //dropify image
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>