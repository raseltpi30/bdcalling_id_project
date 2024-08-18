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
                        <h1 class="m-0">All Customer</h1>
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
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->fname ?? 'N/A' }}</td>
                                                <td>{{ $item->email ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <div class="badge badge-success">Active</div>
                                                    @else
                                                        <div class="badge badge-danger">Inactive</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($item->status == 1)
                                                        <a href="{{ route('admin.Update', $item->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.Update', $item->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    @endif
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
