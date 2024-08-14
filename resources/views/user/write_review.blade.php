@extends('layouts.app')
@section('title')
    Review
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <a href="{{route('write.review')}}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <h4>Write your valuable review for our website</h4>
                   <div class="login-form">
                    <form action="{{route('store.review')}}" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="customer_name">Write Your Review</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{Auth::user()->name}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="details">Write Your Review</label>
                        <textarea type="text" class="form-control" name="review" required=""></textarea>
                      </div>
                      <div class="form-group ">
                        <label for="review">Your Rating For Website</label>
                         <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
                             <option disabled="" selected="">Select Your Review</option>
                             <option value="1">1 star</option>
                             <option value="2">2 star</option>
                             <option value="3">3 star</option>
                             <option value="5">4 star</option>
                             <option value="5">5 star</option>
                         </select> 
                         
                      </div>
                      <input style="cursor: pointer" type="submit" class="btn btn-sm btn-info" value="Submit Review">
                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
