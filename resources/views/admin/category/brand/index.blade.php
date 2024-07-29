@extends('layouts.admin')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Brands Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
    <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Brands list here</h3>
            </div>
                <!-- /.card-header -->
            <div class="card-body">
              <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Brands Name</th>
                      <th>Brands Slug</th>
                      <th>Brand Logo</th>
                      <th>Front Page</th>
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

{{-- Brands insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('brand.store') }}" method="Post" id="add-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
              <label for="brand_name">Brand Name</label>
              <input type="text" id="brand_name" class="form-control"  name="brand_name" required="" placeholder="Brand Name">
              <small id="emailHelp" class="form-text text-muted">This is your Brand Name</small>
            </div>   
            <div class="form-group">
              <label for="brand_logo">Brand Logo</label>
              <input type="file" id="brand_logo" class="form-control"  name="brand_logo" required="" placeholder="Brand Logo">
              <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
              
            </div>   
        </div>
        <div class="modal-footer">
          <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Brand Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
      
     </div>	
    </div>
  </div>
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="{{asset('backend')}}/dist/js/ajax.js"></script>


<script type="text/javascript">
	$(function brand(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('brand.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'brand_name'  ,name:'brand_name'},
				{data:'brand_slug'  ,name:'brand_slug'},
        {data:'brand_logo',name:'brand_logo', render: function(data, type){
					return "<img src=\"files/brand/" +data+ "\"  height=\"20\" width=\"133\"/>";
				}},
				{data:'front_page',name:'front_page'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("brands/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });

</script>

@endsection