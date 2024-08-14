<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// for image intervention
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        $property = Property::all();
        return view('admin.property.index', compact('property'));
    }
    public function create()
    {
        $category = DB::table('categories')->get();
        $country = DB::table('countries')->get();
        $city = DB::table('cities')->get();
        $property_size = DB::table('property_sizes')->get();
        $property_type = DB::table('property_types')->get();
        $amenity = DB::table('amenities')->get();
        return view('admin.property.create', compact('category', 'country', 'city', 'property_size', 'property_type', 'amenity'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'description' => 'required',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['category_id'] = $request->category_id;
        $data['country_id'] = $request->country_id;
        $data['city_id'] = $request->city_id;
        $data['property_size_id'] = $request->property_size_id;
        $data['property_type_id'] = $request->property_type_id;
        $data['property_amenitiy_id'] = $request->property_amenity_id;
        $data['starting_price'] = $request->starting_price;
        $data['selling_price'] = $request->selling_price;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['bedroom'] = $request->bedroom;
        $data['bathroom'] = $request->bathroom;
        $data['description'] = $request->description;
        $data['address'] = $request->address;
        $data['map_url'] = $request->map_url;
        $data['status'] = $request->status;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-Y');
        //single thumbnail
        if ($request->thumbnail) {
            $thumbnail = $request->thumbnail;
            $photoname = $data['slug'] . '.' . $thumbnail->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $thumbnail = $manager->read($request->thumbnail);
            $thumbnail->toJpeg(80)->save(base_path('public/files/property/' . $photoname));
            $data['thumbnail'] = $photoname;   // public/files/property/plus-point.jpg

            // using image intervention
            //  $manager = new ImageManager(new Driver());
            //  $thumbnail = $manager->read($request->thumbnail);
            //  $thumbnail = $thumbnail->resize(32,32);
            //  $thumbnail->toJpeg(80)->save(base_path('public/files/website_setting/'.$photoname));
            //  $data['favicon'] = 'files/website_setting/'.$faviconname;
        }
        //multiple images
        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image);
                $image->toJpeg()->save(base_path('public/files/property/' . $imageName));
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }
        // return $data;
        // Insert data into the 'properties' table and get the inserted ID
        $propertyId = DB::table('properties')->insertGetId($data);

        // Insert data into the 'bids' table using the retrieved property ID
        DB::table('bids')->insert([
            'property_id' => $propertyId,
            'customer_id' => 0,
            'minimum_bid' => $request->starting_price,
            'secondary_bid' => $request->starting_price,
            'maximum_bid' => $request->starting_price,
        ]);

        $notification = array('message' => 'Property Created Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id)
    {
        $category = DB::table('categories')->get();
        $country = DB::table('countries')->get();
        $city = DB::table('cities')->get();
        $property_size = DB::table('property_sizes')->get();
        $property_type = DB::table('property_types')->get();
        $amenity = DB::table('amenities')->get();
        $property = Property::findOrFail($id);
        return view('admin.property.edit', compact('category', 'country', 'city', 'property_size', 'property_type', 'amenity', 'property'));
    }
    public function update(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['category_id'] = $request->category_id;
        $data['country_id'] = $request->country_id;
        $data['city_id'] = $request->city_id;
        $data['property_size_id'] = $request->property_size_id;
        $data['property_type_id'] = $request->property_type_id;
        $data['property_amenitiy_id'] = $request->property_amenity_id;
        $data['starting_price'] = $request->starting_price;
        $data['selling_price'] = $request->selling_price;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['bedroom'] = $request->bedroom;
        $data['bathroom'] = $request->bathroom;
        $data['description'] = $request->description;
        $data['address'] = $request->address;
        $data['map_url'] = $request->map_url;
        $data['status'] = $request->status;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-Y');
        //__old thumbnail ase kina__ jodi thake new thumbnail insert korte hobe
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {
            if (File::exists('files/property/' . $request->old_thumbnail)) {
                FIle::delete('files/property/' . $request->old_thumbnail);
            }
            $thumbnail = $request->thumbnail;
            $photoname = $data['slug'] . '.' . $thumbnail->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $thumbnail = $manager->read($thumbnail);
            // merge the transparent areas with orange
            $thumbnail->toJpeg(80)->save(base_path('public/files/property/' . $photoname));
            $data['thumbnail'] = $photoname;   // public/files/property/plus-point.jpg
        }
        //multiple images
        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image);
                $image->toJpeg()->save(base_path('public/files/property/' . $imageName));
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }
        // return $data;
        DB::table('properties')->where('id', $request->id)->update($data);
        $notification = array('message' => 'Property Updated Successfully!', 'alert-type' => 'success');
        return redirect()->route('property.index')->with($notification);
    }
    public function destroy($id)
    {
        $property = DB::table('properties')->where('id', $id)->first();  //property data get
        if (File::exists('files/property/' . $property->thumbnail)) {
            FIle::delete('files/property/' . $property->thumbnail);
        }

        $images = json_decode($property->images, true);
        if (isset($images)) {
            foreach ($images as $key => $image) {
                if (File::exists('files/property/' . $image)) {
                    FIle::delete('files/property/' . $image);
                }
            }
        }

        DB::table('properties')->where('id', $id)->delete();
        $notification = array('message' => 'property Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
