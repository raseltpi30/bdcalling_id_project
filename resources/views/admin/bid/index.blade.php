@extends('layouts.admin')
@section('admin_content')
    <link rel="stylesheet" href="{{ asset('backend') }}/custom/product/css/dropify.min.css" />
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            background: #428bca;
            ;
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
                        <h1 class="m-0">Country</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 text-right">
                        <button href="#" class="btn btn-info" data-toggle="modal" data-target="#addModal"><i
                                class="fa fa-plus"></i> Add New</button>
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
                                <h3 class="card-title">All blog Country list here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Name</th>
                                            <th>Customer Name</th>
                                            <th>Customer Info</th>
                                            <th>Property Type</th>
                                            <th>Property Min Price</th>
                                            <th>Property Secondary Price</th>
                                            <th>Property Maximum Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bids as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->property->name ?? 'N/A' }}</td>
                                                <td>{{ $item->customer->fname ?? 'N/A' }}</td>
                                                <td>Email: {{ $item->customer->email ?? 'N/A' }}<br>Phone:
                                                    {{ $item->customer->phone ?? 'N/A' }}</td>
                                                <td>{{ $item->property_type->name ?? 'N/A' }}</td>
                                                <td>{{ $item->minimum_bid }}</td>
                                                <td>{{ $item->secondary_bid }}</td>
                                                <td>{{ $item->maximum_bid }}</td>

                                                <td>
                                                    {{-- <a href="#" class="btn btn-info btn-sm edit" data-id="{{$category->id}}" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                                                    <a id="delete" href="{{route('category.delete',['category_id' => $category->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Name</th>
                                            <th>Customer Name</th>
                                            <th>Customer Info</th>
                                            <th>Property Type</th>
                                            <th>Property Min Price</th>
                                            <th>Property Secondary Price</th>
                                            <th>Property Maximum Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
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

            <script src="{{ asset('backend') }}/dist/js/ajax.js"></script>
            <script src="{{ asset('backend') }}/custom/product/js/dropify.min.js"></script>
            <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript">
                $('.dropify').dropify(); //dropify image
                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                });
                $('body').on('click', '.edit', function() {
                    let id = $(this).data('id');
                    $.get("category/edit/" + id, function(data) {
                        $("#modal_body").html(data);
                    });
                });
            </script>
        @endsection
