@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_responsive.css">
@include('layouts.front_partial.collaps_nav')
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">{{$blog_category->category_name}} Blog</h2>
		</div>
	</div>

	@if (count($blog_list)==0)
		<div class="alert alert-danger">
			<h3 class="text-center p-5">
				There has no blog under this category
			</h3>
		</div>
	@else

	<!-- Blog -->
	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						
						<!-- Blog post -->
						@foreach ($blog_list as $single_blog)
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{asset('files/blog/'.$single_blog->thumbnail)}})"></div>
							<div class="blog_text">{{$single_blog->description}}</div>
							<div class="blog_button"><a href="{{route('single.blog',$single_blog->slug)}}">Continue Reading</a></div>
						</div>    
						@endforeach						
					</div>
				</div>
					
			</div>
		</div>
	</div>
	@endif
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
  <script src="{{asset('frontend')}}/js/blog_custom.js"></script>
@endsection