<form action="{{ route('blog.update') }}" method="Post" enctype="multipart/form-data">
  @csrf
  <div class="modal-body">
    <input type="hidden" name="id" value="{{$blog->id}}">
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <select name="blog_category_id" id="category_name" class="form-control">
        @php
          $blog_category = DB::table('blog_category')->get();
        @endphp
        @foreach ($blog_category as $item)             
            <option value="{{$item->id}}" @if($item->id == $blog->blog_category_id) selected @endif >                
            {{$item->category_name}}</option>
        @endforeach
        </select>
    </div> 
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{$blog->title}}" placeholder="Blog title">
    </div> 
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" placeholder="description" cols="5" rows="2">{{$blog->description}}</textarea>
    </div> 
    <div class="form-group">
        <label for="thumbnail">Blog Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail" class="dropify form-control">
        <input type="hidden" name="old_thumbnail" value="{{ $blog->thumbnail }}">
        <div class="preview">
          <img style="" src="{{asset('files/blog/'.$blog->thumbnail)}}" height="30" width="auto" alt="{{$blog->title}}">
        </div>
    </div> 
    <div class="form-group">
        <label for="tag">Blog Tag</label>
        <input type="text" class="form-control" name="tag" id="tag" value="{{$blog->tag}}" placeholder="Blog Tag">
    </div>
    <div class="form-group">
      <label for="status">Blog Status</label>
      <select name="status" id="status" class="form-control">
      <option value="1" @if($blog->status == 1) selected @endif>Active</option>
      <option value="0" @if($blog->status == 0) selected @endif>Inctive</option>
      </select>
    </div>
  </div>

  <div class="modal-footer">
    <button type="Submit" class="btn btn-primary"><span class="loader d-none">..Loading</span>Update</button>
  </div>
</form>

<script src="{{asset('backend')}}/custom/product/js/dropify.min.js"></script>
{{-- <link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/dropify.min.css"/> --}}
<script type="text/javascript">
$('.dropify').dropify(); 
</script> 