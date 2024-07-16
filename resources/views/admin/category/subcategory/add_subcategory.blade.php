@extends('layouts.admin')
@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">subcategory</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="{{route('subcategory.index')}}" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <div class="row">
        <div class="col-sm-10">
          <div class="modal-dialog" role="document">
    
            {!! Form::open([ 'route' => ['subcategory.store'], 'method' => 'post' ]) !!}
            <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="newSaleModalLabel"> Add New subcategory </h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                  <label for="category_id" class="col-sm-4 col-form-label text-right">Category Name *</label> 
                  <div class="col-sm-8">
                    <select class="form-control" name="category_id">
                      @foreach ($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>                            
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="subcategory_name" class="col-sm-4 col-form-label text-right"> subcategory Name *</label>
                    <div class="col-sm-8">
                      <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="SubCategory Name">
                    @error('subcategory_name')
                    <div class="alert alert-danger p-1" style="font-size:14px">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Add New subcategory</button>	
            </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection