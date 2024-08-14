@extends('website.master')

@section('title')
    {{$property->name}}
@endsection

@section('body')
    <main>
        <div class="main-wrapper">
            <div class="section_view_real_estate" style="padding: 4rem 0 6rem 0;">
                <div class="container">
                    <div class="real_estate_display_grid">
                        <div class="real_estate_title">
                            <h3 class="heading-style-h3">{{ $property->name }}</h3>
                            <div class="location_text">
                                <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662202c0c58468fa14215e7d_fi-bs-marker.svg"
                                    loading="lazy" alt="">
                                <div class="text-style-muted">{!! $property->address !!}</div>
                            </div>
                        </div>
                        <div class="divider_line"></div>
                        <div class="real_estate_details">
                            <div id="w-node-a8d19551-4778-0097-8db9-f138cf4659eb-0e2a2261" class="div_left">
                                @php
                                    $images = json_decode($property->images, true);
                                @endphp
                                <div class="custom_list">
                                    <div class="select-img">
                                        <div class="image_selected"><img
                                                src="{{ asset('files/property/' . $property->thumbnail) }}" alt="dfg">
                                        </div>
                                    </div>
                                    <!-- Images -->
                                    <ul class="image_list">
                                        @isset($images)
                                            <li data-image="{{ asset('files/property/' . $property->thumbnail) }}">
                                                <img src="{{ asset('files/property/' . $property->thumbnail) }}" alt="">
                                            </li>
                                            @foreach ($images as $key => $image)
                                                <li data-image="{{ asset('files/property/' . $image) }}">
                                                    <img src="{{ asset('files/property/' . $image) }}" alt="">
                                                </li>
                                            @endforeach
                                        @endisset
                                    </ul>
                                </div>
                                <div id="w-node-f247bf92-5974-45da-a9e0-cbf20b9cc665-0e2a2261" class="real_estate_info">
                                    <h5 class="heading-style-h5">Overview</h5>
                                    <div class="spacer_div"></div>
                                    <div class="visual_info_wrapper">
                                        <div id="w-node-_448dbcbe-6f2e-58aa-6a8e-f930dcdca463-0e2a2261" class="icon_cell">
                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/66221367d19859ef89be5c1e_bed.svg"
                                                loading="lazy" alt="">
                                            <div class="text-size-small">{{ $property->bedroom }}</div>
                                            <div class="text-size-small">Rooms</div>
                                        </div>
                                        <div id="w-node-_5c4b485f-591b-92b5-2674-9fcfb8c0713a-0e2a2261" class="icon_cell">
                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662213c63766dd981431c7b2_bathtub.svg"
                                                loading="lazy" alt="">
                                            <div class="text-size-small">{{ $property->bathroom }}</div>
                                            <div class="text-size-small">Bathrooms</div>
                                        </div>
                                        <div id="w-node-e7801214-bbad-f105-2ef2-eb4cdd428723-0e2a2261" class="icon_cell">
                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662213d35c4638ae2e4cca6e_balcony.svg"
                                                loading="lazy" alt="">
                                            <div class="text-size-small">Justice-facing</div>
                                        </div>
                                        <div id="w-node-e4a7afc8-8777-eb5f-c69a-dc328bc225b7-0e2a2261" class="icon_cell">
                                            <img src="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/662213e2c93f6d2e96ebf492_shelves.svg"
                                                loading="lazy" alt="">
                                            <div class="text-size-small">${{ $property->selling_price }}</div>
                                        </div>
                                    </div>
                                    <div class="spacer_div"></div>
                                    <div class="text_info_wrapper">
                                        <div class="info_text_cell">
                                            <h6 class="heading-style-h6 text-style-muted">Carpet Area</h6>
                                            <div>{{ $property->property_size->name }}</div>
                                        </div>
                                        <div class="info_text_cell">
                                            <h6 class="heading-style-h6 text-style-muted">Build Date</h6>
                                            <div>March 28, 2025</div>
                                        </div>
                                        <div class="info_text_cell">
                                            <h6 class="heading-style-h6 text-style-muted">Property Type</h6>
                                            <div>{{ $property->property_type->name }}</div>
                                        </div>
                                        <div class="info_text_cell">
                                            <h6 class="heading-style-h6 text-style-muted">Flat Direction</h6>
                                            <div>Justice-facing</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form name="email-form" action="{{ route('bid.new') }}" method="POST">
                                @csrf
                                <div id="w-node-f1459dd4-678d-39ad-29ec-e03ab36e9ce4-0e2a2261" class="real_estate_price_details">
                                    <h5 class="heading-style-h5 text-style-muted">Property Value</h5>
                                    <div class="spacer_div"></div>
                                    <h4 class="heading-style-h4">${{ $property->selling_price }}</h4>
                                    <div class="spacer_div"></div>
                                    <div>Your bid cannot be more than 10% of minimum property value.</div>
                                    <div class="spacer_div"></div>

                                    <div id="bidValueUp">
                                        <div style="margin-bottom: 5px;">
                                            <div class="property" data-property-id="{{ $property->id }}">
                                                <span>{{ $bid->minimum_bid }}</span>
                                            </div>
                                        </div>

                                        <input type="number" hidden name="customer_id" value="{{Session::get('customer_id')}}">
                                        <input type="number" hidden name="property_id" value="{{$property->id}}">
                                        <input type="number" hidden name="minimum_bid" value="{{$bid->minimum_bid}}">
                                        <input type="number" hidden name="secondary_bid" value="{{$bid->maximum_bid}}">
                                        <div style="margin-bottom: 5px;">
                                            <h6 class="heading-style-h6">Min Bid</h6>
                                            <div class="range_box_text">
                                                <input style="font-size: 15px" type="number" id="maximum_bid" value="{{ $bid->maximum_bid * 0.1 + $bid->minimum_bid }}" name="maximum_bid" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" style="border: none" class="button_the_second">
                                        Bid Property
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="element-area" style="margin-top: 1.5rem; padding: 2rem;">
                        <div class="heading">
                            <h3>Aminities</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div role="listitem" class="collection-item w-dyn-item w-dyn-repeater-item"><img
                                        src="https://assets-global.website-files.com/6621eca8425e124cf274a6dc/66224338d647330a08a74e17_laundry.svg"
                                        loading="lazy" alt="">
                                    <div>Laundry.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('website/assets/js/jquery.min.js') }}"></script>


@endsection
