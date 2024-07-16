@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="{{ route('page.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
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
                  <h3 class="card-title">All Pages Here</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>SL No</th>
                            <th>Page Name</th>
                            <th>Page Title</th>
                            <th>Page Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $page)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td>{{$page->page_name}}</td>
                                <td>{{$page->page_title}}</td>
                                <td>{{$page->page_description}}</td>
                                <td>                                    
                                  <a href="{{ route('page.edit', ['page_id' => $page->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                  <a id="delete" href="{{route('page.delete',['page_id' => $page->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                        </tbody>
                        @endforeach
                        <tfoot>
                          <tr>
                            <th>SL No</th>
                            <th>Page Name</th>
                            <th>Page Title</th>
                            <th>Page Description</th>
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