@extends('layouts.admin')
@section('admin_content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('product.create') }}" class="btn btn-primary" > + Add New</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="">Details of {{$product->name}} Here </h4>
              </div><br>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-right">Category Name:</th>
                                    <td>{{$product->category->category_name}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Product Name :</th>
                                    <td class="text-capitalize">{{$product->name}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right align-items-center">Thumbnail :</th>
                                    <td><img style="height: 100px;width : 120px" src="{{asset('files/product')}}/{{$product->thumbnail}}" alt=""></td>
                                </tr>
                                <tr>
                                    <th class="text-right">Description :</th>
                                    <td>{!!$product->description!!}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Cost Price :</th>
                                    <td>{{$product->purchase_price}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Selling Price :</th>
                                    <td>{{$product->selling_price}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Tags :</th>
                                    <td>{{$product->tags}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Color :</th>
                                    <td>{{$product->color}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Status :</th>
                                    <td>@if ($product->status == 1)
                                        <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-success">active</span>
                                        @else
                                        <i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-danger">Deactive</span>
                                        
                                    @endif</td>
                                </tr>
                            </table>                    
                        </div>
                    </div>
                </div>
            </div>
	      </div>
	  </div>
	</div>
</section>
</div>
@endsection