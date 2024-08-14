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
                        <div class="card card-body shadow">
                            <h3>Registration Form</h3>
                            <hr>
                            <form action="{{ route('customer.registration') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">First Name :</label>
                                    <input type="text" class="form-control" name="fname" id="name"
                                        placeholder="Enter Your Name">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Last Name :</label>
                                    <input type="text" class="form-control" name="lname" id="username"
                                        placeholder="Enter Your Username">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Enter Your Email">
                                </div>
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile :</label>
                                    <input type="text" class="form-control" name="phone" id="mobile"
                                        placeholder="Enter Your Mobile">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password :</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter Your Password">
                                </div>

                                <div class="mb-3">
                                    <input type="submit" name="registration_form" class="btn btn-primary w-100"
                                        value="Registration">
                                </div>
                                Already have an account? <a href="{{route('customer.login')}}" style="color:blue;padding:10px">Login Now</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
