<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// for image intervention 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // $this->data['categories'] = Category::all();
        $this->data['categories'] = DB::table('categories')->get();
        return view('admin.category.category.index',$this->data);
    }
    public function store(Request $request){
        $formData = $request->all();
        $formData['category_slug'] = Str::slug($request->category_name);  
        // For Image File Upload 
        $photo = $request->category_icon;
        $photoname = $formData['category_slug'].'.'.$photo->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image = $image->resize(32,32);
        $image->toJpeg(80)->save(base_path('public/files/category/'.$photoname));
        $formData['category_icon'] = $photoname;
        Category::create($formData);

        $notification = array('message' => 'Category Created Successfully!','alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }
    // public function store(Request $request){
    //     $formData = $request->all();
    //     $formData['category_slug'] = Str::slug($request->category_name);

    //     $photo = $request->catregory_icon;
    //     $photoname = $formData['category_slug'].'.'.$photo->getClientOriginalExtension();
    //     $manager = new ImageManager(new Driver);
    //     $image = $manager->read($photo);
    //     $image = $image->resize(32,32);
    //     $image->toJpeg(80)->save(base_path('public/files/category'));
    //     $formData['category_icon'] = $photoname;

    //     $notification = array('message' => 'Category Add Successfully!','alert-type' => 'success');
    //     Category::create($formData);

    //     return redirect()->back()->with($notification);
    // }
    public function edit($id){
        $this->data['category'] = Category::findOrFail($id);
        return view('admin.category.category.edit',$this->data);
    }
    //category update without id
    // public function update(Request $request){
    //     $upData['category_name'] = $request->category_name;
    //     $upData['category_slug'] = Str::slug($request->category_name);
    //     $upData['homepage'] = $request->homepage;

    //     if($request->category_icon){
    //         if(File::exists($request->old_icon)){
    //             unlink($request->old_icon);
    //         }
    //         $photo = $request->category_icon;
    //         $photoname = $upData['category_slug'].'.'.$photo->getClientOriginalExtension();
    //         $photo = $request->category_icon;
    //         $manager = new ImageManager(new Driver());
    //         $image = $manager->read($photo);
    //         $image = $image->resize(32,32);
    //         $image->toJpeg(80)->save(base_path('public/files/category/'.$photoname));
    //         $upData['category_icon'] = $photoname;

    //         DB::table('categories')->where('id',$request->id)->update($upData);
    //         $notification = array('message' => 'Category Updated Successfully!','alert-type' => 'success');
    //         return redirect()->route('category.index')->with($notification); 
    //     }else{
    //         $upData['category_icon'] = $request->old_icon;
    //         DB::table('categories')->where('id',$request->id)->update($upData);
    //         $notification = array('message' => 'Category Updated Successfully!','alert-type' => 'success');
    //         return redirect()->route('category.index')->with($notification); 
    //     }
    // }

    //category update with id
    public function update(Request $request,$id){
        $category = Category::findOrFail($id);
        $data = $request->all();
        $category->category_name = $data['category_name'];
        $category->category_slug = Str::slug($data['category_name']);
        $category->homepage = $request->homepage;
        if($request->category_icon){
            if(File::exists($request->old_icon)){
                unlink($request->old_icon);
            }
            $photo = $request->category_icon;
            $photoname = $category->category_slug.'.'.$photo->getClientOriginalExtension();
            $photo = $request->category_icon;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($photo);
            $image = $image->resize(32,32);
            $image->toJpeg(80)->save(base_path('public/files/category/'.$photoname));
            $category->category_icon = $photoname;
            $category->save();
            $notification = array('message' => 'Category Updated Successfully!','alert-type' => 'success');
            return redirect()->route('category.index')->with($notification); 
        }else{
            $category->category_icon = $request->old_icon;
            $category->save();
            $notification = array('message' => 'Category Updated Successfully!','alert-type' => 'success');
            return redirect()->route('category.index')->with($notification); 
        }
        
        $category->save();

    }
    public function destroy($category_id){
        $category = Category::findOrFail($category_id);
        $image = $category->category_icon;
        if(File::exists('files/category/'.$image)){
            unlink('files/category/'.$image);
        }
        $category->delete();
        $notification = array('message' => 'Category Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }
    public function GetChildCategory($id)  //subcategory_id
    {
        $data=DB::table('child_categories')->where('subcategory_id',$id)->get();
        return response()->json($data);
    }

}
