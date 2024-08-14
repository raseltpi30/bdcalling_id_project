<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// for image intervention 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CountryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()){
            $country = Country::all();
            return DataTables::of($country)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('country.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                </a>';
                return $actionbtn; 	

            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $country = Country::all();
        return view('admin.category.country.index',compact('country'));
        
    }
    public function store(Request $request){
        $formData = $request->all();
        $formData['name'] = $request->name;  
        // For Image File Upload 
        $photo = $request->image;
        $photoname = $formData['name'].'.'.$photo->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image->resize(110,70);
        $image->toJpeg(80)->save(base_path('public/files/country/'.$photoname));
        $formData['image'] = $photoname;
        Country::create($formData);

        $notification = array('message' => 'Country Created Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id){
        // $country = Country::findOrFail($id)->first();
        $data = DB::table('countries')->where('id',$id)->first();
        // return $data->name;
        return view('admin.category.country.edit',compact('data'));
    }
    //category update with id
    public function update(Request $request){
        $upData = array();
        $upData['name'] = $request->name;  
        // For Image File Upload 
        $photo = $request->image;
        if($photo){
            if(File::exists($request->old_image)){
                unlink($request->old_image);
            }
            $photoname = $upData['name'].'.'.$photo->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($photo);
            $image->resize(110,70);
            $image->toJpeg(80)->save(base_path('public/files/country/'.$photoname));
            $upData['image'] = $photoname;
        }else{
            $upData['image'] = $request->old_image;
        }        
        DB::table('countries')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'Country Updated Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id){
        $country = Country::findOrFail($id);
        $image = $country->image;
        if(File::exists('files/country/'.$image)){
            unlink('files/country/'.$image);
        }
        $country->delete();
        $notification = array('message' => 'Country Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('country.index')->with($notification);
    }

}

