@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_single_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_single_responsive.css">
@include('layouts.front_partial.collaps_nav')

    {{-- single blog image thumbnail  --}}

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset('files/blog/'.$single_blog->thumbnail)}}" data-speed="0.8"></div>
    </div>

	<!-- Home -->

    <div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">{{$single_blog->title}}</div>
					<div class="single_post_text">
                        {{$single_blog->description}}
                    </div>
				</div>
			</div>
		</div>
	</div>	

    <!-- Blog Posts -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

						<!-- Blog post -->
                        @foreach($related_blog as $related)
                            <div class="blog_post">
                                <div class="blog_image" style="background-image:url({{asset('files/blog/'.$related->thumbnail)}})"></div>
                                <div class="blog_text">{{$related->description}}</div>
                                <div class="blog_button"><a href="{{route('single.blog',$related->slug)}}">Continue Reading</a></div>
                            </div>
                        @endforeach

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

    <script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('frontend')}}/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="{{asset('frontend')}}/js/blog_single_custom.js"></script>
@endsection