@extends('layouts.app')
@section('navbar')
    @include('layouts.front_partial.main_nav')
@endsection
@section('content')
<div class="banner">
    <div class="banner_background" style="background-image:url({{ asset('frontend') }}/images/banner_background.jpg)"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            @isset($bannerproduct->thumbnail)
                <div class="banner_product_image"><img src="{{ asset('files/product/'.$bannerproduct->thumbnail) }}" alt="{{ $bannerproduct->name }}"></div>
            
            
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">{{ $bannerproduct->name }}</h1>
                    @if($bannerproduct->discount_price==NULL)
                     <div class="banner_price">{{ $setting->currency }}{{ $bannerproduct->selling_price }}</div>
                    @else
                      <div class="banner_price"><span>{{ $setting->currency }}{{ $bannerproduct->selling_price }}</span>{{ $setting->currency }}{{ $bannerproduct->discount_price }}</div>
                    @endif
                    <div class="banner_product_name">{{ $bannerproduct->brand->brand_name }}</div>
                    <div class="button banner_button"><a href="{{ route('product.details',$bannerproduct->slug) }}">Shop Now</a></div>
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>
<!-- Characteristics -->

<div class="characteristics">
    <div class="container">
        <div class="row">

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">
                
                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('frontend')}}/images/char_1.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">
                
                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('frontend')}}/images/char_2.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">
                
                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('frontend')}}/images/char_3.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">
                
                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{asset('frontend')}}/images/char_4.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deals of the week -->

<div class="deals_featured">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
                
                <!-- Deals -->

                <div class="deals">
                    <div class="deals_title">Deals of the Week</div>
                    <div class="deals_slider_container">
                        
                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            
                            <!-- Deals Item -->
                            @foreach($today_deal as $deal)
                                <div class="owl-item deals_item">
                                    <div class="deals_image"><img src="{{asset('files/product/'.$deal->thumbnail)}}" alt=""></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category"><a href="#">{{$deal->category->category_name}}</a></div>
                                            
                                        </div>
                                        <div class="deals_info_line d-flex justify-content-between align-items-center">
                                            <div class="deals_item_name">{{substr($deal->name,0,10)}}...</div>
                                            @if ($deal->discount_price == NULL)
                                                    <div class="product_price discount m-0">{{$setting->currency}}{{$deal->selling_price}}</span></div>
                                                @else
                                                    <div class="product_price discount m-0">{{$setting->currency}}{{$deal->discount_price}}<span>{{$setting->currency}}{{$deal->selling_price}}</span></div>
                                                @endif
                                        </div>
                                        <div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>6</span></div>
                                                <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                            </div>
                                            <div class="available_bar"><span style="width:17%"></span></div>
                                        </div>
                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                    </div>
                </div>
                
                <!-- Featured -->
                <div class="featured">
                    <div class="tabbed_container">
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="active">Featured</li>
                                <li>Most Popular Product</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <!-- Product Panel -->
                        <div class="product_panel panel active">
                            <div class="featured_slider slider">
                                <!-- Slider Item -->
                                @foreach ($featured as $product)
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/'.$product->thumbnail)}}" alt="{{$product->name}}"  width="90%" height="100%"></div>
                                            <div class="product_content">
                                                @if ($product->discount_price == NULL)
                                                    <div class="product_price discount">{{$setting->currency}}{{$product->selling_price}}</span></div>
                                                @else
                                                    <div class="product_price discount">{{$setting->currency}}{{$product->discount_price}}<span>{{$setting->currency}}{{$product->selling_price}}</span></div>
                                                @endif
                                                <div class="product_name"><div><a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></div></div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                       <a href="#" class="quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">quick view</a>
                                                    </div>
                                                    <button class="product_cart_button quick_view"  id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                </div>
                                            </div>
                                            {{-- <div class="product_fav"><i class="fas fa-heart"></i></div> --}}
                                            <a href="{{ route('product.wishlist',$product->id) }}">
                                                <div class="product_fav">
                                                   <i class="fas fa-heart"></i>
                                                </div>
                                            </a>
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount">-25%</li>
                                                <li class="product_mark product_new">new</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>
                        <!-- Product Panel -->
                        <div class="product_panel panel">
                            <div class="featured_slider slider">
                                <!-- Slider Item -->
                                @foreach ($popular_product as $product)
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/'.$product->thumbnail)}}" alt="{{$product->name}}"  width="90%" height="100%"></div>
                                            <div class="product_content">
                                                @if ($product->discount_price == NULL)
                                                    <div class="product_price discount">{{$setting->currency}}{{$product->selling_price}}</span></div>
                                                @else
                                                    <div class="product_price discount">{{$setting->currency}}{{$product->discount_price}}<span>{{$setting->currency}}{{$product->selling_price}}</span></div>
                                                @endif
                                                <div class="product_name"><div><a href="{{route('product.details',$product->slug)}}">{{$product->name}}</a></div></div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                       <a href="#" class="quick_view" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">quick view</a>
                                                    </div>
                                                    <button class="product_cart_button quick_view"  id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('product.wishlist',$product->id) }}">
                                                <div class="product_fav">
                                                   <i class="fas fa-heart"></i>
                                                </div>
                                            </a>
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount">-25%</li>
                                                <li class="product_mark product_new">new</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->

<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content">
                    <div class="popular_categories_title">Popular Categories</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                    <div class="popular_categories_link"><a href="">full catalog</a></div>
                </div>
            </div>
            
            <!-- Popular Categories Slider -->

            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">

                        <!-- Popular Categories Item -->
                        @foreach ($category as $row)
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="{{asset('files/category/'.$row->category_icon)}}" alt="{{$row->category_name}}"></div>
                                    <a href="{{route('categorywise.product',$row->id)}}">
                                        <div class="popular_category_text">{{$row->category_name}}</div>
                                    </a>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->

<div class="banner_2">
    <div class="banner_2_background" style="background-image:url({{asset('frontend')}}/images/banner_2_background.jpg)"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{asset('frontend')}}/images/banner_2_product.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div>

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{asset('frontend')}}/images/banner_2_product.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div>

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>
                                
                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{asset('frontend')}}/images/banner_2_product.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>			
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Home Category wise product-->

@foreach($home_category as $row)
@php 
  $cat_product=DB::table('products')->where('category_id',$row->id)->orderBy('id','DESC')->limit(24)->get();
@endphp
 <div class="new_arrivals">
     <div class="container">
         <div class="row">
             <div class="col">
                 <div class="tabbed_container">
                     <div class="tabs clearfix tabs-right">
                        <a href="{{route('categorywise.product',$row->id)}}">
                            <div class="new_arrivals_title">{{ $row->category_name }}</div>
                        </a>
                         <ul class="clearfix">
                             <li class=""><a href=""> view more </a></li>
                         </ul>
                         <div class="tabs_line"><span></span></div>
                     </div>
                     <div class="row">
                         <div class="col-lg-12" style="z-index:1;">
                             <!-- Product Panel -->
                             <div class="product_panel panel active">
                                 <div class="arrivals_slider slider">

                                    @foreach($cat_product as $row) 
                                     <!-- Slider Item -->
                                     <div class="arrivals_slider_item">
                                         <div class="border_active"></div>
                                         <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                             <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}" height="100%" width="55%"></div>
                                             <div class="product_content">
                                                 @if($row->discount_price==NULL)
                                                   <div class="product_price discount">{{ $setting->currency }}{{ $row->selling_price }}</div>
                                                 @else
                                                   <div class="product_price discount">{{ $setting->currency }} {{ $row->discount_price }}<span>{{ $setting->currency }} {{ $row->selling_price }}</span></div>
                                                 @endif
                                                 
                                                 <div class="product_name"><div><a href="{{ route('product.details',$row->slug) }}">{{ $row->name }}</a></div></div>
                                                 <div class="product_extras">
                                                     <div class="product_color">
                                                         <a href="" class="quick_view" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">quick view</a>
                                                     </div>
                                                     <button class="product_cart_button quick_view"  id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter">Add to Cart</button>
                                                 </div>
                                             </div>
                                             <a href="{{ route('product.wishlist',$row->id) }}">
                                                <div class="trends_fav">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            </a>                      
                                         </div>
                                     </div>
                                    @endforeach 
              
                                 </div>
                                 <div class="arrivals_slider_dots_cover"></div>
                             </div>
                     </div>
                    </div>       
                 </div>
             </div>
         </div>
     </div>      
 </div>
@endforeach 

<!-- Adverts -->

<div class="adverts">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 advert_col">
                
                <!-- Advert Item -->

                <div class="advert d-flex flex-row align-items-center justify-content-start">
                    <div class="advert_content">
                        <div class="advert_title"><a href="#">Trends 2018</a></div>
                        <div class="advert_text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                    </div>
                    <div class="ml-auto"><div class="advert_image"><img src="{{asset('frontend')}}/images/adv_1.png" alt=""></div></div>
                </div>
            </div>

            <div class="col-lg-4 advert_col">
                
                <!-- Advert Item -->

                <div class="advert d-flex flex-row align-items-center justify-content-start">
                    <div class="advert_content">
                        <div class="advert_subtitle">Trends 2018</div>
                        <div class="advert_title_2"><a href="#">Sale -45%</a></div>
                        <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                    </div>
                    <div class="ml-auto"><div class="advert_image"><img src="{{asset('frontend')}}/images/adv_2.png" alt=""></div></div>
                </div>
            </div>

            <div class="col-lg-4 advert_col">
                
                <!-- Advert Item -->

                <div class="advert d-flex flex-row align-items-center justify-content-start">
                    <div class="advert_content">
                        <div class="advert_title"><a href="#">Trends 2018</a></div>
                        <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                    </div>
                    <div class="ml-auto"><div class="advert_image"><img src="{{asset('frontend')}}/images/adv_3.png" alt=""></div></div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Trends -->

<div class="trends">
    <div class="trends_background" style="background-image:url({{asset('frontend')}}/images/trends_background.jpg)"></div>
    <div class="trends_overlay"></div>
    <div class="container">
        <div class="row">

            <!-- Trends Content -->
            <div class="col-lg-3">
                <div class="trends_container">
                    <h2 class="trends_title">Trends 2018</h2>
                    <div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
                    <div class="trends_slider_nav">
                        <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Trends Slider -->
            <div class="col-lg-9">
                <div class="trends_slider_container">

                    <!-- Trends Slider -->

                    <div class="owl-carousel owl-theme trends_slider">

                        <!-- Trends Slider Item -->
                        @foreach ($trendy_product as $row)
                            <div class="owl-item">
                                <div class="trends_item is_new">
                                    <div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/'.$row->thumbnail)}}" alt="{{$row->name}}"></div>
                                    <div class="trends_content">
                                        <div class="trends_category text-capitalize">
                                            <a href="{{route('categorywise.product',$row->category->id)}}">
                                                {{$row->category->category_name}}</a>
                                        </div>
                                        <div class="trends_info clearfix">
                                            <div class="trends_name"><a href="{{route('product.details',$row->slug)}}">{{ substr($row->name,0,8) }}..</a></div>
                                            <div class="trends_price">
                                                @if ($row->discount_price == NULL)
                                                    <div class="bestsellers_price discount">{{$setting->currency}}{{$row->selling_price}}</span></div>
                                                @else
                                                    <div class="bestsellers_price m-0 discount">{{$setting->currency}}{{$row->discount_price}}<span>{{$setting->currency}}{{$row->selling_price}}</span></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="trends_marks">
                                        <li class="trends_mark trends_discount">-25%</li>
                                        <li class="trends_mark trends_new">new</li>
                                    </ul>
                                    <a href="{{ route('product.wishlist',$product->id) }}">
                                        <div class="trends_fav">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Reviews -->

<div class="reviews">
    <div class="container">
        <div class="row">
            <div class="col">
                
                <div class="reviews_title_container">
                    <h3 class="reviews_title">Latest Reviews</h3>
                    <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
                </div>

                <div class="reviews_slider_container">
                    
                    <!-- Reviews Slider -->
                    <div class="owl-carousel owl-theme reviews_slider">
                        
                        <!-- Reviews Slider Item -->
                        @foreach ($review as $row)
                        @php
                            $user = DB::table('users')->where('id',$row->user_id)->first();
                        @endphp
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div><div class="review_image">
                                        @if (@isset($user->profile_picture))
                                            <img src="{{asset('files/profile/'.$user->profile_picture)}}" alt="">
                                        @else
                                            <img src="{{asset('frontend')}}/images/review_1.jpg" alt="">
                                        @endif
                                    </div></div>
                                    <div class="review_content">
                                        <div class="review_name">{{$row->name}}</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                @if($row->rating==5)
                                                    <div>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                    </div>
                                                @elseif($row->rating==4)
                                                    <div>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                @elseif($row->rating==3)
                                                    <div>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                @elseif($row->rating==2)
                                                    <div>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                @elseif($row->rating==1)
                                                    <div>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="review_time">{{$row->review_date}}</div>
                                        </div>
                                        <div class="review_text"><p>{{$row->review}}</p></div>
                                    </div>
                                </div>
                            </div>                            
                        @endforeach
                    </div>
                    <div class="reviews_dots"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Top Viwed Products</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">
                    
                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        
                        <!-- Recently Viewed Item -->
                        @foreach ($random_product as $row)
                            <div class="owl-item">
                                <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{asset('files/product/'.$row->thumbnail)}}" alt="{{$row->name}}"></div>
                                    <div class="viewed_content text-center">
                                        @if($row->discount_price==NULL)
                                            <div class="viewed_price">{{ $setting->currency }}{{ $row->selling_price }}</div>
                                        @else
                                            <div class="viewed_price">{{ $setting->currency }} {{ $row->discount_price }}<span>{{ $setting->currency }} {{ $row->selling_price }}</span></div>
                                        @endif
                                            <div class="viewed_name"><a href="{{route('product.details',$row->slug)}}">{{substr($row->name,0,10)}}...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">
                    
                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">
                        @foreach ($brand as $row)                   
                        <div class="brands_item d-flex flex-column justify-content-center">
                            <a href="{{ route('brandwise.product',$row->id) }}" title="{{ $row->brand_name }}"> <img src="{{ asset('files/brand/'.$row->brand_logo) }}" alt="{{ $row->brand_name }}" height="50" width="40"> </a>
                         </div>                           
                        @endforeach     
                    </div>
                    
                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="quick_view_body">
     
        </div>
      </div>
    </div>
  </div>
<script src="{{asset('backend')}}/dist/js/ajax.js"></script>
<script type="text/javascript">
    //ajax request send for collect childcategory
     $(document).on('click', '.quick_view', function(){ 
      var id = $(this).attr("id");
      $.ajax({
           url: "{{ url("/product-quick-view/") }}/"+id,
           type: 'get',
           success: function(data) {
                $("#quick_view_body").html(data);
           }
        });
     });
    //  $('body').on('click','#add_to_wishlist',function(){
    //     var id = $(this).data('id');
    //     var url = $(this).attr('action');
    //     $.ajax({
    //         url:url,
    //         type:'get',
    //         async:false,
    //         success:function(data){
    //             toastr.success(data);
    //         }
    //     })
    //  });
</script>

@endsection