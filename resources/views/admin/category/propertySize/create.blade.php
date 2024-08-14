@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/bootstrap-tagsinput.css"/>
<script type="text/javascript" src="{{asset('backend')}}/custom/product/js/bootstrap-tagsinput.min.js"></script>
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
            <h1 class="m-0">category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="{{route('category.index')}}" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <div class="row">
        <div class="col-sm-10">
          <div class="modal-dialog" role="document">
          <form action="{{route('category.store')}}" method="Post">
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
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Add New Category</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('backend')}}/dist/js/ajax.js"></script>
  <script src="{{asset('backend')}}/custom/product/js/dropify.min.js"></script>
  <link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/dropify.min.css"/>
  <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

  <script type="text/javascript">
    $('.dropify').dropify();  //dropify image
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
  </script>
@endsection