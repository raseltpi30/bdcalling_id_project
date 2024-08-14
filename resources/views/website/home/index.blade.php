@extends('website.master')

@section('title')
    Home Page
@endsection

@section('body')
    <section class="banner-area">
        <div class="banner">
            <div class="banner-content bg-white">
                <div class="row">
                    <div class="col-md-12">
                        <div class="work-smarter-tabs">
                            <ul class="nav nav-pills" id="work-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="account-tab" data-bs-toggle="pill"
                                        data-bs-target="#create-account-content" type="button" role="tab">Buy</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="install-tab" data-bs-toggle="pill"
                                        data-bs-target="#intall-content" type="button" role="tab">Rent</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="track-tab" data-bs-toggle="pill"
                                        data-bs-target="#track-content" type="button" role="tab">PG</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="work-tabContent">
                                <div class="tab-pane fade show active" id="create-account-content" role="tabpanel"
                                    tabindex="0">
                                    <div class="tabs-content">
                                        <form method="POST" action="{{ route('search.properties') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="filter_wrapper">
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Your Location</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field" name="city_id"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a city</option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->city_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662372a5fd9f586ebc33ccc3_fi-bs-home-location.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Property Type</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field-2" name="property_type_id"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a PropertyType
                                                                </option>
                                                                @foreach ($propertyTypes as $propertyType)
                                                                    <option value="{{ $propertyType->id }}">
                                                                        {{ $propertyType->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6623731c420708fcbda8bd3c_Subtract.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Budget</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field-2" name="budget"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a Budget</option>
                                                                <option value="100">$100 & below</option>
                                                                <option value="150-200">$150 - $200</option>
                                                                <option value="201">$201 & above</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="find_property_button w-button btn-info w-100"><i
                                                    class='fas fa-search'></i> Find Property </button>
                                        </form>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="intall-content" role="tabpanel" tabindex="0">
                                    <div class="tabs-content">
                                        <form method="POST" action="{{ route('search.properties') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="filter_wrapper">
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Your Location</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field" name="city_id"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a city</option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->city_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662372a5fd9f586ebc33ccc3_fi-bs-home-location.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Property Type</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field-2" name="property_type_id"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a PropertyType
                                                                </option>
                                                                @foreach ($propertyTypes as $propertyType)
                                                                    <option value="{{ $propertyType->id }}">
                                                                        {{ $propertyType->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6623731c420708fcbda8bd3c_Subtract.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Budget</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field-2" name="budget"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a Budget</option>
                                                                <option value="100">$100 & below</option>
                                                                <option value="150-200">$150 - $200</option>
                                                                <option value="201">$201 & above</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="find_property_button w-button btn-info w-100"><i
                                                    class='fas fa-search'></i> Find Property </button>
                                        </form>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-content" role="tabpanel" tabindex="0">
                                    <div class="tabs-content">
                                        <form method="POST" action="{{ route('search.properties') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="filter_wrapper">
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Your Location</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field" name="city_id"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a city</option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}">
                                                                        {{ $city->city_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662372a5fd9f586ebc33ccc3_fi-bs-home-location.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Property Type</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field-2" name="property_type_id"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a PropertyType
                                                                </option>
                                                                @foreach ($propertyTypes as $propertyType)
                                                                    <option value="{{ $propertyType->id }}">
                                                                        {{ $propertyType->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="filter_block">
                                                        <div class="filter_visual">
                                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6623731c420708fcbda8bd3c_Subtract.svg"
                                                                loading="lazy" alt="">
                                                            <div class="filter_name">Budget</div>
                                                        </div>
                                                        <div class="w-form">
                                                            <select id="field-2" name="budget"
                                                                class="filter_selector w-select">
                                                                <option value="" selected>Select a Budget</option>
                                                                <option value="100">$100 & below</option>
                                                                <option value="150-200">$150 - $200</option>
                                                                <option value="201">$201 & above</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="find_property_button w-button btn-info w-100"><i
                                                    class='fas fa-search'></i> Find Property </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            {{-- <form action="/search" class="search_wrapper w-form">
                                <input class="w-input" maxlength="256" name="query" placeholder="Search Properties…"
                                    type="search" id="search" required="">
                                <button type="submit" class="find_property_button w-button btn-info w-100"><i
                                        class='fas fa-search'></i> Find Property </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="counter-area" style="padding-top: 180px;">
        <div class="container">
            <div class="counter-box">
                <div class="row">
                    <div class="col-md-3">
                        <div class="counter-1 count">
                            <h1>2k+</h1>
                            <p>New Flate Listed</p>
                            <a href="#" class="link-block_category_card w-inline-block">
                                <div>View All</div>
                                <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622c525999f58a093cd7de6_icon.svg"
                                    loading="lazy" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-2 count">
                            <h1>2k+</h1>
                            <p>New Flate Listed</p>
                            <a href="#" class="link-block_category_card w-inline-block">
                                <div>View All</div>
                                <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622c525999f58a093cd7de6_icon.svg"
                                    loading="lazy" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-3 count">
                            <h1>2k+</h1>
                            <p>New Flate Listed</p>
                            <a href="#" class="link-block_category_card w-inline-block">
                                <div>View All</div>
                                <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622c525999f58a093cd7de6_icon.svg"
                                    loading="lazy" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-4 count">
                            <h1>2k+</h1>
                            <p>New Flate Listed</p>
                            <a href="#" class="link-block_category_card w-inline-block">
                                <div>View All</div>
                                <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622c525999f58a093cd7de6_icon.svg"
                                    loading="lazy" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="property-area">
        <div class="container">
            <div class="property-all section-padding">
                <div class="property-heading">
                    <h2>Popular Properties</h2>
                    <a href="#">See all properties</a>
                </div>
                <div class="row">
                    <div class="owl-carousel owl-theme" id="myCarousel">
                        @foreach ($popular_property as $item)
                            <a href="{{ route('propertyDetails', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                class="w-inline-block">
                                <div class="property_card">
                                    <img src="{{ asset('files/property/' . $item->thumbnail) }}" loading="lazy"
                                        alt="Property Image">
                                    <div class="property-content">
                                        <div class="spacer_div"></div>
                                        <div class="property_category_info">
                                            <div class="category_tag">
                                                <div class="text-weight-semibold text-size-small">
                                                    {{ $item->category->category_name }}</div>
                                            </div>
                                            <div class="div-block">
                                                <div class="orange_dot"></div>
                                                <div class="text-size-small">Ready To Move</div>
                                            </div>
                                        </div>
                                        <div class="line_blue_fade"></div>
                                        <h4>{{ $item->city->city_name }}</h4>
                                        <div class="address_Info">
                                            <img ````
                                                src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg"
                                                loading="lazy" alt="Location Marker">
                                            <div class="text-size-tiny">{!! $item->address !!}</div>
                                        </div>
                                        <div class="text-weight-semibold">${{ $item->selling_price }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-area section-padding">
        <div class="container">
            <div class="property-heading">
                <h2>Popular Properties</h2>
                <a href="#">See all properties</a>
            </div>
            <div class="owl-carousel owl-theme" id="myCarousel3">
                @foreach ($new_property as $item)
                    <a href="{{ route('propertyDetails', ['id' => $item->id, 'slug' => $item->slug]) }}"
                        class="w-inline-block">
                        <div class="property_card">
                            <img src="{{ asset('files/property/' . $item->thumbnail) }}" loading="lazy"
                                alt="Property Image">
                            <div class="property-content">
                                <div class="spacer_div"></div>
                                <div class="property_category_info">
                                    <div class="category_tag">
                                        <div class="text-weight-semibold text-size-small">
                                            {{ $item->category->category_name }}</div>
                                    </div>
                                    <div class="div-block">
                                        <div class="orange_dot"></div>
                                        <div class="text-size-small">Ready To Move</div>
                                    </div>
                                </div>
                                <div class="line_blue_fade"></div>
                                <h4>{{ $item->city->city_name }}</h4>
                                <div class="address_Info">
                                    <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg"
                                        loading="lazy" alt="Location Marker">
                                    <div class="text-size-tiny">{!! $item->address !!}</div>
                                </div>
                                <div class="text-weight-semibold">${{ $item->selling_price }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="testimonial-area section-padding">
        <div class="container">
            <div class="section-heading">
                <h1>Testimonials</h1>
            </div>
            <div class="owl-carousel owl-theme" id="myCarousel2">
                <div class="single-testimonial">
                    <div class="star">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                    </div>
                    <p>"Living at Tranquil Heights has been a dream come true. The serene surroundings and top-notch
                        amenities exceed all expectations!"</p>
                    <img class="person"
                        src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622aaf521b2a2c043f5e452_Ellipse%201.png"
                        alt="">
                    <h4>James Toriff</h4>
                    <h5>Marketing Manageer, XYZ</h5>
                </div>
                <div class="single-testimonial">
                    <div class="star">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                    </div>
                    <p>"Living at Tranquil Heights has been a dream come true. The serene surroundings and top-notch
                        amenities exceed all expectations!"</p>
                    <img class="person"
                        src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622aaf521b2a2c043f5e452_Ellipse%201.png"
                        alt="">
                    <h4>James Toriff</h4>
                    <h5>Marketing Manageer, XYZ</h5>
                </div>
                <div class="single-testimonial">
                    <div class="star">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                    </div>
                    <p>"Living at Tranquil Heights has been a dream come true. The serene surroundings and top-notch
                        amenities exceed all expectations!"</p>
                    <img class="person"
                        src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622aaf521b2a2c043f5e452_Ellipse%201.png"
                        alt="">
                    <h4>James Toriff</h4>
                    <h5>Marketing Manageer, XYZ</h5>
                </div>
                <div class="single-testimonial">
                    <div class="star">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622ab836d838466d66783fe_grade.svg"
                            alt="">
                    </div>
                    <p>"Living at Tranquil Heights has been a dream come true. The serene surroundings and top-notch
                        amenities exceed all expectations!"</p>
                    <img class="person"
                        src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6622aaf521b2a2c043f5e452_Ellipse%201.png"
                        alt="">
                    <h4>James Toriff</h4>
                    <h5>Marketing Manageer, XYZ</h5>
                </div>
            </div>
        </div>
    </section>
@endsection
