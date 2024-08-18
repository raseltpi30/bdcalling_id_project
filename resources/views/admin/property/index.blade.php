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
                        <a href="{{ route('property.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
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
                                            <th>Property Name</th>
                                            <th>Slug</th>
                                            <th>Category Name</th>
                                            <th>Thumbnail</th>
                                            <th>Country Name</th>
                                            <th>City Name</th>
                                            <th>Property Size</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($property as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>{{ $item->category->category_name }}</td>
                                                <td><img src="{{ asset('files/property/' . $item->thumbnail) }}"
                                                        height="50" width="100" alt=""></td>
                                                <td>{{ $item->country->name }}</td>
                                                <td>{{ $item->city->city_name }}</td>
                                                <td>{{ $item->property_size->name }}</td>
                                                <td>
                                                    <a href="{{ route('property.edit', $item->id) }}"
                                                        class="btn btn-info btn-sm edit"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('property.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete"><i
                                                            class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('backend') }}/dist/js/ajax.js"></script>
    <script type="text/javascript">
        $('.dropify').dropify(); //dropify image
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endsection
