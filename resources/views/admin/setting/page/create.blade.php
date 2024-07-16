@extends('layouts.admin')
@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="{{route('page.index')}}" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <div class="row">
        <div class="col-10" style="margin:50px auto;">
          <div>
            @if (isset($page))
                {!! Form::model($page,[ 'route' => ['page.update','page_id' => $page->id], 'method' => 'post' ]) !!}                            
            @else
            {!! Form::open([ 'route' => ['page.store'], 'method' => 'post' ]) !!}
            @endif
            <div class="modal-content col-12">
            <div class="modal-header">
                @if (isset($page))
                  <h5 class="modal-title" id="newSaleModalLabel"> Update page </h5>    
                @else
                  <h5 class="modal-title" id="newSaleModalLabel"> Add New page </h5>
                @endif                
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    @if (isset($page))
                        <label for="page_position" class="col-sm-2 col-form-label text-right">Page Position *</label>
                        <div class="col-sm-10">
                            <select name="page_position" id="page_position" class="form-control">
                                <option value="1" @if ($page->page_position == 1) selected @endif>Line One</option>
                                <option value="2" @if ($page->page_position == 2) selected @endif>Line Two</option>
                            </select>
                            @error('page_position')
                                <div class="alert alert-danger p-1" style="font-size:14px">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>  
                    @else
                        <label for="page_position" class="col-sm-2 col-form-label text-right">Page Position *</label>
                        <div class="col-sm-10">
                            <select name="page_position" id="page_position" class="form-control">
                                <option value="1">Line One</option>
                                <option value="2">Line Two</option>
                            </select>
                            @error('page_position')
                                <div class="alert alert-danger p-1" style="font-size:14px">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif 
                </div>
                <div class="form-group row">
                    <label for="page_name" class="col-sm-2 col-form-label text-right">Page Name *</label>
                    <div class="col-sm-10">
                    {{ Form::text('page_name', NULL, [ 'class'=>'form-control', 'id' => 'page_name', 'placeholder' => 'page Name']) }}
                    @error('page_name')
                    <div class="alert alert-danger p-1" style="font-size:14px">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="page_title" class="col-sm-2 col-form-label text-right">Page Title *</label>
                    <div class="col-sm-10">
                    {{ Form::text('page_title', NULL, [ 'class'=>'form-control', 'id' => 'page_title', 'placeholder' => 'Page Title']) }}
                    @error('page_title')
                    <div class="alert alert-danger p-1" style="font-size:14px">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="page_description" class="col-sm-2 col-form-label text-right">Page Description *</label>
                    <div class="col-sm-10">
                    {{ Form::textarea('page_description', NULL, [ 'class'=>'form-control textarea', 'id' => 'page_description', 'placeholder' => 'Page Description','col' => '10','row' => 2]) }}
                    @error('page_description')
                    <div class="alert alert-danger p-1" style="font-size:14px">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if (isset($page))
                  <button type="submit" class="btn btn-primary">Update page</button>	
                @else
                  <button type="submit" class="btn btn-primary">Add New page</button>	
                @endif
            </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection