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
            <a href="{{ route('subcategory.addItem') }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
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
                    <table id="example1" class="table table-bordered table-striped">
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
                            @foreach ($subcategories as $key => $subcategory)
                            <tr>
                                {{-- <td> {{$key+1}} </td> --}}
                                <td> {{$subcategory->id}} </td>
                                <td>{{$subcategory->subcategory_name}}</td>
                                <td>{{$subcategory->subcategory_slug}}</td>
                                <td>{{$subcategory->category->category_name}}</td>
                                <td>
                                    
                                  <a href="{{ route('subcategory.edit', ['subcategory_id' => $subcategory->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                  <a id="delete" href="{{route('subcategory.delete',['subcategory_id' => $subcategory->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                        </tbody>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>SL No</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Action</th>
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