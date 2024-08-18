<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()){
            $city = DB::table('cities')
                ->leftJoin('countries','cities.country_id','countries.id')
                ->select('cities.*','countries.name')->get();
            return DataTables::of($city)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('city.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                </a>';
                return $actionbtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $country = Country::all();
        $city = City::all();
        return view('admin.category.city.index',compact('city','country'));

    }
    public function store(Request $request){
        $formData = array();
        // return $formData;
        $formData['city_name'] = $request->name;
        $formData['country_id'] = $request->country_id;
        // For Image File Upload

        DB::table('cities')->insert($formData);

        $notification = array('message' => 'city Created Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id){
        // $city = city::findOrFail($id)->first();
        // return $id;
        $country = Country::all();
        $data = DB::table('cities')->where('id',$id)->first();
        return view('admin.category.city.edit',compact('data','country'));
    }
    //category update with id
    public function update(Request $request){
        $upData = $request->all();
        $upData = array();
        $upData['city_name'] = $request->name;
        $upData['country_id'] = $request->country_id;
        // For Image File Upload
        DB::table('cities')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'City Updated Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id){
        $city = City::findOrFail($id);
        $city->delete();
        $notification = array('message' => 'city Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('city.index')->with($notification);
    }

}
