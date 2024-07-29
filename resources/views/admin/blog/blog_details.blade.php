@extends('layouts.admin')
@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"> + Add New</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All blog categories list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Blog Category Name</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Thumbnail</th>
                      <th>Description</th>
                      <th>Tags</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

{{-- blog insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('blog.store') }}" method="Post" enctype="multipart/form-data" enctype="multipart/form-data">
      	@csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <select name="blog_category_id" id="category_name" class="form-control">
                @php
                    $blog_category = DB::table('blog_category')->get();
                @endphp
                @foreach ($blog_category as $item)                  
                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                @endforeach
                </select>
            </div> 
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Blog title">
            </div> 
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" placeholder="description" cols="5" rows="2"></textarea>
            </div> 
            <div class="form-group">
                <label for="thumbnail">Blog Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="dropify" required>
            </div> 
            <div class="form-group">
                <label for="tag">Blog Tag</label>
                <input type="text" class="form-control" name="tag" id="tag" value="" placeholder="Blog Tag">
            </div>
            <div class="form-group">
                <label for="status">Blog Status</label>
                <select name="status" id="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inctive</option>
                </select>
              </div>
        </div>
      
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
        
      </div>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
        
      </div>
    </div>
  </div>
</div>

<script src="{{asset('backend')}}/dist/js/ajax.js"></script> 
<script src="{{asset('backend')}}/custom/product/js/dropify.min.js"></script>
<link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/dropify.min.css"/>


<script type="text/javascript">
$('.dropify').dropify(); 
  $(function blog(){
		table=$('.ytable').DataTable({
			"processing":true,
			"serverSide":true,
			"searching":true,
			"ajax":{
			"url": "{{ route('blog.index') }}", 
		},
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'category_name'  ,name:'category_name'},
				{data:'title'  ,name:'title'},
				{data:'slug'  ,name:'slug'},
				{data:'thumbnail'  ,name:'thumbnail'},
				{data:'description'  ,name:'description'},
				{data:'tag'  ,name:'tag'},
				{data:'status',name:'status'},
        {data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});

	// $('body').on('click','.edit', function(){
	// 	let cat_id=$(this).data('id');
  //   alert(cat_id);
	// 	// $.get("admin/blog_category/edit/"+cat_id, function(data){
	// 		 $("#modal_body").html(data);
	// 	// });
	// });
	// }); ata 2 ta prefix dhorte pare na tai kaj hoina 
  $('body').on('click','.edit', function(){
	  var id=$(this).data('id');
    // alert(id);
		var url = "{{ url('blog_category/edit') }}/"+id;
    // alert(url);
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        	$("#modal_body").html(data);
	    	}
	  	});
    });//2 ta prefix dhorte pare tai kaj hoi

</script>

@endsection