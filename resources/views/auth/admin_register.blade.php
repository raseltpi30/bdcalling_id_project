@extends('layouts.admin')
@section('admin_content')
<div class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>&nbsp;Panel</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Admin Register Panel</p>
  
        <form  action="{{ route('admin.register') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
          </div>
          <div class="input-group mb-3">
            <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Phone">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
          </div>
          @if(session('error'))
                {{-- <span class="invalid-feedback" role="alert"> --}}
                    <strong style="color:red">{{ session('error') }}</strong>
                {{-- </span> --}}
            @endif
          <div class="input-group mb-3">
            <input type="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
            </div>
        </form>  
        <p class="mb-1">
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        </p>
        Dont Have a account? <a href="{{route('admin.register')}}">Register</a>
    </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
  <!-- /.login-box -->
    

@endsection