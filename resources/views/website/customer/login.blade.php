@extends('website.master')

@section('title')
    Home
@endsection

@section('body')
    <div class="container">
        <div class="login-area py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 mt-2">
                        <div class="card card-body p-5 shadow">
                            <h3>Login Form</h3>
                            <hr>
                            <form action="{{ route('customer.login') }}" method="post">
                                @csrf


                                <div class="mb-3">
                                    <label for="email" class="form-label">User Name :</label>
                                    <input type="text" class="form-control" name="user_name" id="userName"
                                        placeholder="Enter Your Email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password :</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter Your Password">
                                </div>

                                <div class="mb-3">
                                    <input style="font-size:2rem" type="submit" name="registration_form" class="btn btn-primary"
                                        value="Login">
                                </div>
                                Dont Have a Account? <a href="{{route('customer.registration')}}" style="color:blue;padding:10px">Registration Now</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
