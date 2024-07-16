@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Website Setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Website Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('setting.website.update',$setting->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="currency">Currency</label>
                    <select class="form-control" name="currency" id="currency">
                        <option value="৳" {{ ($setting->currency == '৳') ? 'selected': '' }} >Taka (৳)</option>
                        <option value="$" {{ ($setting->currency == '$') ? 'selected': '' }}>USD ($)</option>
                     <option value="₹" {{ ($setting->currency == '₹') ? 'selected': '' }}>Rupee (₹)</option>
                   </select>
                  </div>
                  <div class="form-group">
                    <label for="phone_one">Phone One</label>
                    <input type="text" class="form-control" name="phone_one" id="phone_one" placeholder="Phone One" value="{{ $setting->phone_one}}">
                  </div>
                  <div class="form-group">
                    <label for="phone_two">Phone Two</label>
                    <input type="text" class="form-control" name="phone_two" id="phone_one" placeholder="Phone Two" value="{{ $setting->phone_two}}">
                  </div>
                  <div class="form-group">
                    <label for="main_email">Main Email</label>
                    <input type="text" class="form-control" name="main_email" id="main_email" placeholder="Enter Mail Port Here" value="{{ $setting->main_email}}">
                  </div>
                  <div class="form-group">
                    <label for="support_email">Suppport Email</label>
                    <input type="text" class="form-control" name="support_email" id="support_email" placeholder="Support Email" value="{{ $setting->support_email}}">
                  </div>
                  <div class="form-group">
                    <label for="username">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ $setting->address}}">
                  </div>
                  <div class="form-group">
                    <small class="text-success">------Logo and Favicon Field------</small>
                  </div>
                  <input type="hidden" name="id" value="{{ $setting->id }}">
                  <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" id="logo" class="form-control"  name="logo" placeholder="Brand Logo">
                    <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
                    <div class="preview">
                      {{-- if image file problem than using asset  --}}
                      <img style="object-fit:cover" src="{{asset($setting->logo)}}" alt="">
                    </div>
                    <small id="emailHelp" class="form-text text-muted">This is your Logo</small>        
                  </div> 
                  {{-- favicon  --}}
                  <div class="form-group">
                    <label for="favicon">favicon</label>
                    <input type="file" id="favicon" class="form-control"  name="favicon" placeholder="Favicon">
                    <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
                    <div class="preview">
                      {{-- if image file problem than using asset  --}}
                      <img style="object-fit:cover" src="{{asset($setting->favicon)}}" alt="">
                    </div>
                    <small id="emailHelp" class="form-text text-muted">This is your Favicon</small>        
                  </div> 
                  <div class="form-group">
                    <small class="text-success">------Social Icon Field------</small>
                  </div>
                  <div class="form-group">
                    <label for="password">Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="{{ $setting->facebook}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Twitter</label>
                    <input type="text" class="form-control" name="twitter" id="twitter" placeholder="twitter" value="{{ $setting->twitter}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Instagram</label>
                    <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram" value="{{ $setting->instagram}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" id="twitter" placeholder="Linkedin" value="{{ $setting->linkedin}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Youtube</label>
                    <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Youtube" value="{{ $setting->youtube}}">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Website Setting</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection