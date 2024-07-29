@php
	$setting = DB::table('settings')->get()->first();
@endphp
@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/cart_responsive.css">
@include('layouts.front_partial.collaps_nav')
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart_container card p-1">
						<div class="cart_title text-center">Billing Address</div>
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>      
							</div>  
						@endif				
						<form action="{{route('order.place')}}" method="post" id="order-place">
							@csrf
							<div class="row p-4">
							<div class="form-group col-lg-6">
								<label for="c_name">Customer Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{ Auth::user()->name }}" name="c_name" id="c_name" required>
							</div>
							<div class="form-group col-lg-6">
								<label for="c_phone">Customer Phone <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="c_phone"  id="c_phone" required>
							</div>
							<div class="form-group col-lg-6">
								<label for="c_country"> Country <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="c_country"  id="c_country" required>
							</div>
							<div class="form-group col-lg-6">
								<label for="c_address">Shipping Address <span class="text-danger">*</span> </label>
								<input type="text" class="form-control" name="c_address"  id="c_address" required>
							</div>
							
							<div class="form-group col-lg-6">
								<label for="c_email">Email Address</label>
								<input type="text" class="form-control" name="c_email" id="c_email" value="{{Auth::user()->email}}" required>
							</div>
							<div class="form-group col-lg-6">
								<label for="c_zipcode">Zip Code</label>
								<input type="text" class="form-control" name="c_zipcode"  id="c_zipcode" required>
							</div>
							<div class="form-group col-lg-6">
								<label for="c_city">City Name</label>
								<input type="text" class="form-control" name="c_city"  id="c_city" required>
							</div>
							<div class="form-group col-lg-6">
								<label for="c_extra_phone">Extra Phone</label>
								<input type="text" class="form-control" name="c_extra_phone"  id="c_extra_phone">
							</div>
								<br>
								<div class="form-group col-lg-4">
									<label for="paypal">Paypal</label>
									<input type="radio"  name="payment_type" value="Paypal" id="paypal">
								</div>
								<div class="form-group col-lg-4">
									<label for="bkash">Bkash/Rocket/Nagad </label>
									<input type="radio"  name="payment_type" checked="" value="Aamarpay" id="bkash">
								</div>
								<div class="form-group col-lg-4">
									<label for="hand_cash">Hand Cash</label>
									<input type="radio"  name="payment_type" value="Hand Cash" id="hand_cash">
								</div>
								
							</div>
							<div class="form-group pl-2">
								<button type="submit" class="btn btn-info p-2" style="cursor: pointer">Order Place</button>
							</div>
							<span class="visually-hidden pl-2 d-none progress">Progressing.....</span>
						</form>
						<!-- Order Total -->						
					</div>
				</div>
				<div class="col-lg-4" >
					<div class="card">
						<div class="pl-4 pt-2">
							<p style="color: black;">Subtotal: <span style="float: right; padding-right: 5px;">{{ Cart::subtotal() }} {{ $setting->currency }}</span> </p>
							{{-- coupon apply --}}
							@if(Session::has('coupon'))
							<p style="color: black;">coupon:({{ Session::get('coupon')['name'] }}) <a href="{{route('remove.coupon')}}" class="text-danger">X</a> <span style="float: right; padding-right: 5px;">{{ Session::get('coupon')['discount'] }} {{ $setting->currency }}</span>  </p>
							@else
							@endif

							<p style="color: black;">Tax: <span style="float: right; padding-right: 5px;">0.00 %</span></p>
							<p style="color: black;">shipping: <span style="float: right; padding-right: 5px;">0.00 {{ $setting->currency }}</span></p>

							@if(Session::has('coupon'))
							<p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Session::get('coupon')['after_discount'] }}{{ $setting->currency }} </span></b></p>
							@else
								<p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Cart::total() }} {{ $setting->currency }} </span></b></p>
							@endif
						</div><hr>

						@if(!Session::has('coupon'))
						<form action="{{route('apply.coupon')}}" method="post">
							@csrf
							<div class="p-4">
							<div class="form-group">
								<label>Coupon Apply</label>
								<input type="text" class="form-control" name="coupon"  placeholder="Coupon Code" autocomplete="off">
							</div>
							<div class="form-group">
								<button style="cursor: pointer" type="submit" class="btn btn-info">Apply Coupon</button>
							</div>
							</div>	
						</form>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="{{asset('backend')}}/dist/js/ajax.js"></script>
    <script type="text/javascript">
        $('#order-place').submit(function(e) {
            $('.progress').removeClass('d-none');
        });
   </script>
@endsection