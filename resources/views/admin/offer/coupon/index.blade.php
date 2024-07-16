@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Warehouse</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
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
                <h3 class="card-title">All Coupon list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Coupon Code</th>
                        <th>Coupon Type</th>
                        <th>Amount</th>
                        <th>Valid Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>                      
                    </thead>
                    <tbody>

                  
                    </tbody>
                  </table>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

{{-- Brands insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('coupon.store') }}" method="Post" id="add-form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" id="coupon_code" class="form-control"  name="coupon_code" required="" placeholder="Coupon Code">
          </div> 
          <div class="form-group">
            <label for="type">Coupon Type</label>
            <select name="type" class="form-control" id="type">
                <option value="Fixed">Fixed</option>
                <option value="Fixed">Percentage</option>
            </select>
          </div> 
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" id="amount" class="form-control"  name="amount" required="" placeholder="Amount">
          </div> 
          <div class="form-group">
            <label for="valid_date">Valid Date</label>
            <input type="date" id="valid_date" class="form-control"  name="valid_date" required="" placeholder="valid_date">
          </div> 
          <div class="form-group">
            <label for="status">Coupon Status</label>
            <select name="status" class="form-control" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="loading d-none"> Loading....</span> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
      
     </div>	
    </div>
  </div>
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="{{asset('backend')}}/dist/js/ajax.js"></script>


<script type="text/javascript">
	$(function coupon(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('coupon.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'coupon_code'  ,name:'coupon_code'},
				{data:'type'  ,name:'type'},
				{data:'amount'  ,name:'amount'},
				{data:'valid_date'  ,name:'valid_date'},
				{data:'status'  ,name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});
  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("coupon/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });

</script>

@endsection