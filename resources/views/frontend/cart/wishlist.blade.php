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
            <div class="col-lg-12 ">
                <div class="cart_container">
                    @if(count($wishlist) == 0)
                        <div class="text-danger">
                            <h1 class="text-center p-5">Wishlist is empty</h1>
                        </div>
                    @else
                        <div class="cart_title">Wishlist</div>
                      <div class="cart_items">
                        <ul class="cart_list">
                            @foreach($wishlist as $row)
                            <li class="cart_item clearfix">                                
                                <div class="cart_item_image">
                                     <img src="{{ asset('files/product/'.$row->thumbnail) }}" alt="">
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{ substr($row->name,0,15) }}..</div>
                                    </div>                                    
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{$row->date}}</div>
                                    </div>                                    
                                    <div class="cart_item_total cart_info_col">                                        
                                        <div class="cart_item_text text-danger">
                                            <a href="{{route('product.details',$row->slug)}}" class="button cart_button_checkout">Checkout</a>
                                        </div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">                                        
                                        <div class="cart_item_text text-danger">
                                            <a href="{{route('wishlistproduct.remove',$row->id)}}" data-id="{{ $row->id }}"> X</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach                            
                        </ul>
                        </div>
                    

                        <!-- Order Total -->
                        <div class="cart_buttons">
                            <a href="{{route('empty.wishlist')}}" class="button cart_button_clear btn-danger">Empty Wishlist</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{asset('frontend')}}/images/send.png" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="{{route('newsletter')}}" class="newsletter_form" method="POST">
                            @csrf
                            <input type="email" name="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                            <button class="newsletter_button" type="submit">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('backend')}}/dist/js/ajax.js"></script>
<script>
    $('body').on('click','#removeProduct', function(){
        let id=$(this).data('id');
        $.ajax({
            url:'{{ url('wishlistproduct/remove/') }}/'+id,
            type:'get',
            async:false,
            success:function(data){
                toastr.success(data);
            }
        });
    });
</script>
@endsection