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
              <li class="breadcrumb-item active">SMTP Setting</li>
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
                <h3 class="card-title">SMTP</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('setting.smtp.update',$smtp->id)}}" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="mailer">Mail Mailer</label>
                    <input type="text" class="form-control" name="mailer" id="mailer" placeholder="Mailer" value="{{ $smtp->mailer}}">
                  </div>
                  <div class="form-group">
                    <label for="host">Mail Host Name</label>
                    <input type="text" class="form-control" name="host" id="host" placeholder="Mail Hostname" value="{{ $smtp->host}}">
                  </div>
                  <div class="form-group">
                    <label for="port">Mail Port</label>
                    <input type="text" class="form-control" name="port" id="port" placeholder="Enter Mail Port Here" value="{{ $smtp->port}}">
                  </div>
                  <div class="form-group">
                    <label for="username">Mail Username</label>
                    <input type="text" class="form-control" name="user_name" id="username" placeholder="Mail Username" value="{{ $smtp->user_name}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Mail Password</label>
                    <input type="text" class="form-control" name="password" id="username" placeholder="Mail Password" value="{{ $smtp->password}}">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update SMTP</button>
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
