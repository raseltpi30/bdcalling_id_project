<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        Category::create($formData);

        $notification = array('message' => 'Category Created Successfully!','alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }
    public function edit($id){
        $this->data['category'] = Category::findOrFail($id);
        return view('admin.category.category.edit',$this->data);
    }
    //category update with id
    public function update(Request $request,$id){
        $category = Category::findOrFail($id);
        $data = $request->all();
        $category->category_name = $data['category_name'];
        $category->category_slug = Str::slug($data['category_name']);
        $category->save();
        $notification = array('message' => 'Category Updated Successfully!','alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);

    }
    public function destroy($category_id){
        $category = Category::findOrFail($category_id);
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
