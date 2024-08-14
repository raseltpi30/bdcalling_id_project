<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popular_property = Property::where('status', 1)->orderBy('property_views', 'DESC')->get();
        $new_property = Property::where('status', 1)->orderBy('id', 'DESC')->get();
        $cities   = City::all();
        $propertyTypes = PropertyType::all();
        return view('website.home.index', compact('popular_property', 'new_property', 'cities', 'propertyTypes'));
    }
    public function propertyDetails($id, $slug)
    {
        // Fetch the property by slug
        $property = Property::where('slug', $slug)->first();

        // Increment the product_views for the property if it exists
        if ($property) {
            $property->increment('property_views');
        }

        // Fetch the latest bid related to the property
        $bid = Bid::where('property_id', $id)->latest()->first();

        // Return the view with the property and bid data
        return view('website.home.property_details', compact('property', 'bid'));
    }


    public function searchProperties(Request $request)
    {
        $cityId = $request->input('city_id');
        $propertyTypeId = $request->input('property_type_id');
        $budget = $request->input('budget');
        $properties = Property::when($cityId, function ($query) use ($cityId) {

            $query->where('city_id', $cityId);
        })
            ->when($propertyTypeId, function ($query) use ($propertyTypeId) {
                $query->where('property_type_id', $propertyTypeId);
            })->when($budget, function ($query) use ($budget) {
                if ($budget == '100') {
                    $query->where('starting_price', '<=', 100);
                } elseif ($budget == '150-200') {
                    $query->whereBetween('starting_price', [150, 200]);
                } elseif ($budget == '201') {
                    $query->where('starting_price', '>=', 201);
                }
            })->get();
        return view('website.search.index', compact('properties'));
    }

    public function getBidDetails($property_id)
    {
        try {
            $bid = Bid::where('property_id', $property_id)->orderBy('amount', 'desc')->first();

            if ($bid) {
                $maximum_bid = $bid->amount;
            } else {
                $property = Property::findOrFail($property_id);
                $maximum_bid = $property->starting_price + ($property->starting_price * 0.1);
            }

            return response()->json(['maximum_bid' => $maximum_bid]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch bid details'], 500);
        }
    }

    public function bidNew(Request $request){
        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['property_id'] = $request->property_id;
        $data['minimum_bid'] = $request->minimum_bid;
        $data['secondary_bid'] = $request->secondary_bid;
        $data['maximum_bid'] = $request->maximum_bid;

        DB::table('bids')->insert($data);
        return redirect()->route('')->with($notification);
    }
}
