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
            <h1 class="m-0">Cities</h1>
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
                <h3 class="card-title">All city list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>City Name</th>
                      <th>Coutry Name</th>
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

{{-- Category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Country</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('city.store')}}" method="Post">
          @csrf
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-right">Name *</label>
                    <div class="col-sm-8">
                      <input type="text" name="name" id="name" class="form-control" placeholder="name Name">
                      <small id="emailHelp" class="form-text text-muted">This is your Name</small>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="category_id" class="col-sm-4 col-form-label text-right">Country Name *</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="country_id" required="">
                      @foreach ($country as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
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
      </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
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
$(function city(){
		var table = $('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('city.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'city_name'  ,name:'city_name'},
				{data:'name'  ,name:'name'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});
  $('.dropify').dropify();  //dropify image
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    // alert(id);
    $.get("city/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });
</script>
@endsection
