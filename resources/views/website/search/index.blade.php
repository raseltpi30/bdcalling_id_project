@extends('website.master')

@section('title')
    Search Page
@endsection

@section('body')
    <main>
        <div class="search-content section-padding">
            <div class="container">
                <h2 class="search"> {{count($properties)}} search results</h2>
                @if(count($properties) > 0)
                    @foreach($properties as $property)
                        <div role="listitem" class="w-dyn-item mb-5">
                            <a href="{{ route('propertyDetails', ['id' => $property->id, 'slug' => $property->slug]) }}" class="search_result_link w-inline-block">
                                <div class="search_result_card">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="search-img">
                                                <img src="{{ asset('files/property/'.$property->thumbnail)}}" loading="lazy" alt="Property Thumbnail" class="search_result_image_thumbnile">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="search_result_text">
                                                <h4 class="heading-style-h4">
                                                    {{ $property->name }}
                                                </h4>
                                                <div class="address_info-_type_two">
                                                    <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg" loading="lazy" alt="Location Icon">
                                                    <div class="text-size-tiny">
                                                        {{ $property->address}},{{$property->city->city_name}},{{$property->country->name}}
                                                    </div>
                                                </div>
                                                <div class="card_div_disign">
                                                    <div class="text-block-2">Property Details</div>
                                                    <div class="orange_line"></div>
                                                </div>
                                                <div class="amenities_wrapper">
                                                    <div class="amenities_box">
                                                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/66235939c3d16f2cc9b0527e_Group%202.svg" loading="lazy" alt="Total Area Icon">
                                                        <div class="amenities_box_text">
                                                            <div class="bold_text text-weight-bold">Total Area</div>
                                                            <div class="text-size-tiny">{{ $property->property_size->name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities_box">
                                                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/66235939f3938884d08e6a14_Group%201.svg" loading="lazy" alt="Availability Icon">
                                                        <div class="amenities_box_text">
                                                            <div class="bold_text text-weight-bold">Availability</div>
                                                            <div class="text-size-tiny">
                                                                @if ($property->stock_quantity == NULL)
                                                                <span class="btn btn-iinfo bg-danger text-white">Stock Out</span>
                                                                @else
                                                                    <span class="btn btn-iinfo bg-success text-white">Avaible</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="amenities_box">
                                                        <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/66235939c3d16f2cc9b0527e_Group%202.svg" loading="lazy" alt="Random Icon">
                                                        <div class="amenities_box_text">
                                                            <div class="bold_text text-weight-bold">Name</div>
                                                            <div class="text-size-tiny">{{ $property->created_at }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>No properties found matching your search criteria.</p>
                @endif
            </div>
        </div>

    </main>
@endsection
