<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PropertyTypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()){
            $propertyType = DB::table('property_types')->get();
            return DataTables::of($propertyType)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('PropertyType.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                </a>';
                return $actionbtn; 	
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $propertyType = PropertyType::all();
        return view('admin.category.propertyType.index',compact('propertyType'));
        
    }
    public function store(Request $request){
        $formData = array();
        // return $formData;
        $formData['name'] = $request->name;  
        // For Image File Upload 
        
        DB::table('property_types')->insert($formData);
        $notification = array('message' => 'propertyType Created Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id){
        // $propertyType = propertyType::findOrFail($id)->first();
        // return $id;
        $data = DB::table('property_types')->where('id',$id)->first();
        return view('admin.category.propertyType.edit',compact('data'));
    }
    public function update(Request $request){
        $upData = array();
        $upData['name'] = $request->name;  
        DB::table('property_types')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'propertyType Updated Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id){
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->delete();
        $notification = array('message' => 'PropertyType Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('PropertyType.index')->with($notification);
    }

}
