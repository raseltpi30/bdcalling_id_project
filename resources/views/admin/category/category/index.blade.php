@extends('layouts.admin')

@section('admin_content')
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
            <a href="{{ route('category.addItem') }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
            <img height="100" width="100" src="files/website_setting/017741410.png" alt="hhhh">
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
                  <h3 class="card-title">All Categories Here </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
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
                                    
                                  <a href="{{ route('category.edit', ['category_id' => $category->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                  <a id="delete" href="{{route('category.delete',['category_id' => $category->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                        </tbody>
                        @endforeach
                        <tfoot>
                        <tr>
                          <tr>
                            <th>SL No</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Category Icon</th>
                            <th>Homepage</th>
                            <th>Action</th>
                          </tr>                          
                        </tr>
                        </tfoot>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection