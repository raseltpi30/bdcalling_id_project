<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\PropertySize;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PropertySizeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()){
            $propertySize = DB::table('property_sizes')->get();
            return DataTables::of($propertySize)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('PropertySize.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                </a>';
                return $actionbtn; 	
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $propertySize = propertySize::all();
        return view('admin.category.propertySize.index',compact('propertySize'));
        
    }
    public function store(Request $request){
        $formData = array();
        // return $formData;
        $formData['name'] = $request->name;  
        // For Image File Upload 
        
        DB::table('property_sizes')->insert($formData);

        $notification = array('message' => 'propertySize Created Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id){
        // $propertySize = propertySize::findOrFail($id)->first();
        // return $id;
        $data = DB::table('property_sizes')->where('id',$id)->first();
        return view('admin.category.propertySize.edit',compact('data'));
    }
    //category update with id
    public function update(Request $request){
        $upData = $request->all();
        $upData = array();
        $upData['name'] = $request->name;  
        // For Image File Upload    
        DB::table('property_sizes')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'propertySize Updated Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function destroy($id){
        $propertySize = PropertySize::findOrFail($id);
        $propertySize->delete();
        $notification = array('message' => 'propertySize Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('PropertySize.index')->with($notification);
    }

}