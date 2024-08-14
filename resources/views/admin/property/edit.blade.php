@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/bootstrap-tagsinput.css"/>
<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('property.update') }}" method="post" enctype="multipart/form-data">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Property</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <input type="hidden" name="id" value="{{$property->id}}">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">property Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="name" value="{{$property->name}}" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Category<span class="text-danger">*</span> </label>
                      <select class="form-control" name="category_id" id="subcategory_id">
                        @foreach($category as $row)
                           <option value="{{$row->id}}" @if($row->id==$property->category_id) selected @endif>{{ $row->category_name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Country<span class="text-danger">*</span> </label>
                        <select class="form-control" name="country_id" id="subcategory_id">
                          @foreach($country as $row)
                             <option value="{{$row->id}}" @if($row->id==$property->country_id) selected @endif>{{ $row->name }}</option>
                          @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">City <span class="text-danger">*</span> </label>
                      <select class="form-control" name="city_id" id="subcategory_id">
                        @foreach($city as $row)
                           <option value="{{$row->id}}" @if($row->id==$property->city_id) selected @endif>{{ $row->city_name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Property Size<span class="text-danger">*</span> </label>
                      <select class="form-control" name="property_size_id" id="subcategory_id">
                        @foreach($property_size as $row)
                           <option value="{{$row->id}}" @if($row->id==$property->property_size_id) selected @endif>{{ $row->name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Property Type<span class="text-danger">*</span> </label>
                      <select class="form-control" name="property_type_id" id="subcategory_id">
                        @foreach($property_type as $row)
                           <option value="{{$row->id}}"  @if($row->id==$property->property_type_id) selected @endif>{{ $row->name }}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Amenity<span class="text-danger">*</span> </label>
                      <select class="form-control" name="property_amenity_id" id="subcategory_id">
                        @foreach($amenity as $row)
                           <option value="{{$row->id}}"  @if($row->id==$property->property_amenity_id) selected @endif>{{ $row->name }}</option>
                        @endforeach 
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Purchase Price  </label>
                      <input type="text" class="form-control" value="{{$property->starting_price}}" name="starting_price">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="selling_price" value="{{$property->selling_price}}" class="form-control" required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Stock Qantity<span class="text-danger">*</span> </label>
                      <input type="number" name="stock_quantity" value="{{$property->stock_quantity}}" class="form-control" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInput"> Bed Rooms </label>
                      <input type="text" class="form-control" value="{{$property->bedroom}} name="bedroom">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Bath Rooms <span class="text-danger">*</span> </label>
                      <input type="text" name="bathroom" value="{{$property->bathroom}}" class="form-control" required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Flat Side <span class="text-danger">*</span> </label>
                      <input type="text" name="flatside" value="{{$property->flatside}}" class="form-control" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Property Details</label>
                      <textarea class="form-control textarea" name="description">{{$property->description}}</textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Property Address</label>
                      <textarea class="form-control textarea" name="address">{{$property->address}}</textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Map Url</label>
                      <textarea class="form-control textarea" name="map_url">{{$property->map_url}}</textarea>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
            <!-- /.card -->
          <!-- right column -->
          <div class="col-md-4">
            <!-- Form Element sizes -->
            <div class="card card-primary">
              <div class="card-body">
                  <div class="form-group">
                    <div class="form-group">
                      <img src="{{asset('files/property/'.$property->thumbnail)}}" style="height: 50px; width:50px;">
                      <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                      <input type="file" name="thumbnail"  accept="image/*" class="dropify">
                      <input type="hidden" name="old_thumbnail" value="{{ $property->thumbnail }}" >
                    </div><br>
                    <div class="">  
                      <table class="table table-bordered" id="dynamic_field">
                      <div class="card-header">
                        <h3 class="card-title">More Images (Click Add For More Image)</h3>
                      </div> 
                        <tr>  
                            <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>   
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                        </tr>  
                            @php
                               $images = json_decode($property->images,true);
                            @endphp
                            @if(!$images)
                            @else
                            <div class="row" >
                             @foreach($images as $key => $image)
                               <div class="col-md-4 new-image" >
                                  <img alt="" src="{{asset('files/property/'.$image)}}" style="width: 100px; height: 80px; padding: 10px;"/>
                                  <input type="hidden" name="old_images[]" value="{{ $image }}">
                                  <button type="button" class="remove-files" style="border: none;">X</button>
                               </div>
                             @endforeach
                             </div>
                            @endif
  
                      </table>    
                    </div>
                     <div class="card p-4">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
           <button class="btn btn-info ml-2" type="submit">Submit</button>
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div> 

<script src="{{asset('backend')}}/dist/js/ajax.js"></script>
<script src="{{asset('backend')}}/custom/product/js/dropify.min.js"></script>
<link rel="stylesheet" href="{{asset('backend')}}/custom/product/css/dropify.min.css"/>
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="{{asset('backend')}}/custom/product/js/bootstrap-tagsinput.min.js"></script>


<script type="text/javascript">
  $('.dropify').dropify();  //dropify image
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });



    $(document).ready(function(){      
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;  


       $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       });  

       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
       });  
                //edit product imahe remove by cros btn
      $('.remove-files').on('click', function(){
          $(this).parents(".new-image").remove();
      });
     }); 

 



</script>
@endsection