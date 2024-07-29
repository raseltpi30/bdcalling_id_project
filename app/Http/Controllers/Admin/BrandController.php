<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

// for image intervention 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if($request->ajax()){
            $this->data = Brand::all();
            return DataTables::of($this->data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('brand.delete',['brand_id'=> $row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                </a>';
                
                return $actionbtn; 	

            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $this->data['brand'] = Brand::all();
        return view('admin.category.brand.index',$this->data);
        
    }
    public function store(Request $request){
        $formData = $request->all();
        $formData['brand_slug'] = Str::slug($request->brand_name);  
        // For Image File Upload 
        $photo = $request->brand_logo;
        $photoname = $formData['brand_slug'].'.'.$photo->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image->resize(110,70);
        $image->toJpeg(80)->save(base_path('public/files/brand/'.$photoname));
        $formData['brand_logo'] = $photoname;
        Brand::create($formData);

        $notification = array('message' => 'Brand Created Successfully!','alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
    public function destroy($brand_id){
        $brand = Brand::findOrFail($brand_id);
        $image = $brand->brand_logo;
        if(File::exists('files/brand/'.$image)){
            unlink('files/brand/'.$image);
        }
        $brand->delete();
        $notification = array('message' => 'Brand Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
    public function edit($id){
        $data = DB::table('brands')->where('id',$id)->first();
        return $data->brand_name;
        return view('admin.category.brand.edit',compact('data'));
    } 
    public function update(Request $request){
        $upData['brand_name'] = $request->brand_name;
        $upData['brand_slug'] = Str::slug($request->brand_name);

        if($request->brand_logo){
            if(File::exists($request->old_logo)){
                unlink($request->old_logo);
            }
            $photo = $request->brand_logo;
            $photoname = $upData['brand_slug'].'.'.$photo->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($photo);
            $image->resize(110,70);
            $image->toJpeg(80)->save(base_path('public/files/brand/'.$photoname));
            $upData['brand_logo'] = $photoname;

            DB::table('brands')->where('id',$request->id)->update($upData);
            $notification = array('message' => 'Brand Updated Successfully!','alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification); 
        }else{
            $upData['brand_logo'] = $request->old_logo;
            DB::table('brands')->where('id',$request->id)->update($upData);
            $notification = array('message' => 'Brand Updated Successfully!','alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification); 
        }
    }
}
