@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subcategories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <button href="#" class="btn btn-info"  data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All SubCategories Here </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped ytable">
                        <thead>
                          <tr>
                            <th>SL No</th>
                            <th>SubCategory Name</th>
                            <th>SubCategory Slug</th>
                            <th>Category Name</th>
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
</div>
</div>

{{-- Category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="{{route('subcategory.store')}}" method="Post">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="newSaleModalLabel"> Add New SubCategory </h5>               
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="subcategory_name" class="col-sm-4 col-form-label text-right"> Category Name *</label>
                  <div class="col-sm-8">
                    <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="SubCategory Name">
                    <small id="emailHelp" class="form-text text-muted">This is your SubCategory Name</small>                  
                  </div>
              </div>
              <div class="form-group row">
                <label for="category_id" class="col-sm-4 col-form-label text-right">Category Name *</label> 
                <div class="col-sm-8">
                  <select class="form-control" name="category_id" required="">
                    @foreach ($category as $cat)
                      <option value="{{$cat->id}}">{{$cat->category_name}}</option>                            
                    @endforeach
                  </select>
                  <small id="emailHelp" class="form-text text-muted">This is your Category Name</small>
                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add New SubCategory</button>
          </div>
        </div>
      </form>
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
     <div id="modal_body">
      
     </div>	
    </div>
  </div>
</div>

<script src="{{asset('backend')}}/dist/js/ajax.js"></script>
<script type="text/javascript">
 $(function category(){
  var table = $('.ytable').DataTable({
    processing :true,
    serverSide:true,
    ajax:"{{ route('subcategory.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'subcategory_name'  ,name:'subcategory_name'},
				{data:'subcategory_slug'  ,name:'subcategory_slug'},
				{data:'category_name'  ,name:'category_name'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
  });
 });
 $('body').on('click','.edit',function(){
  let id=$(this).data('id');
  // alert(id);
  $.get("subcategory/edit/"+id,function(data){
    $('#modal_body').html(data);
  });
 });
</script>
@endsection