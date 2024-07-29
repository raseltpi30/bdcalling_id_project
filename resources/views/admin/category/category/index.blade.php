@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/dropify.min.css"/>
<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
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
                <h3 class="card-title">All blog categories list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th>SL No</th>
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Category Icon</th>
                        <th>Homepage</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $key => $category)
                      <tr>
                          <td> {{$key+1}} </td>
                          <td>{{$category->category_name}}</td>
                          <td>{{$category->category_slug}}</td>
                          <td><img src="{{asset('files/category/'.$category->category_icon)}}" alt="{{$category->category_name}}"></td>
                          <td>
                            @if ($category->homepage == 1)
                              <span class="badge badge-success">Homepage</span>
                            @else
                              <span class="badge badge-danger">Not Homepage</span>
                            @endif
                          </td>
                          <td>                                    
                            <a href="#" class="btn btn-info btn-sm edit" data-id="{{$category->id}}" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                            <a id="delete" href="{{route('category.delete',['category_id' => $category->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>                       
                        <tfoot>
                          <tr>
                            <th>SL No</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Category Icon</th>
                            <th>Homepage</th>
                            <th>Action</th>
                          </tr>                          
                        </tfoot>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="{{route('category.store')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="newSaleModalLabel"> Add New Category </h5>               
          </div>
          <div class="modal-body">
              <div class="form-group row">
                  <label for="category_name" class="col-sm-4 col-form-label text-right"> Category Name *</label>
                  <div class="col-sm-8">
                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name">
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
                    @error('category_icon')
                    <div class="alert alert-danger p-1" style="font-size:14px">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
              </div>
              <div class="form-group row">
                  <label for="homepage" class="col-sm-4 col-form-label text-right"> Homepage *</label>
                  <div class="col-sm-8">
                      <input type="checkbox" name="homepage" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success" id="homepage">
                      @error('homepage')
                        <div class="alert alert-danger p-1" style="font-size:14px">
                            {{ $message }}
                        </div>
                      @enderror
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add New Category</button>
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
<script src="{{asset('backend')}}/custom/product/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> 
<script type="text/javascript">
  $('.dropify').dropify();  //dropify image
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("category/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });
</script>
@endsection