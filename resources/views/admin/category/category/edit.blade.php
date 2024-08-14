<form action="{{route('category.update',$category->id)}}" method="Post">
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