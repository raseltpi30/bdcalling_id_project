<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        // $data = DB::table('subcategories')->leftjoin('categories','subcategories.category_id','categories.id')->select('subcategories.*','categories.category_name');
        

        // $data = DB::table('categories')
        // ->leftJoin('subcategories', 'categories.id', '=', 'subcategories.id')
        // ->get();
        
        // joining the posts table , where user_id and posts_user_id are same


        // $this->data['subcategories'] = DB::table('subcategories')
        // ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')->select('subcategories.*','categories.category_name')
        // ->get();// joining the posts table , where user_id and posts_user_id are same
        $this->data['subcategories'] = SubCategory::all();
        $this->data['categories'] = Category::all();
        return view('admin.category.subcategory.index',$this->data);

        // return $this->data;
    }
    public function addItem(){
        $this->data['category'] = Category::all();
        $this->data['mode']         = 'create';
        return view('admin.category.subcategory.add_subcategory',$this->data);
    }
    public function store(Request $request){
        $formData = $request->all();
        $validated = $request->validate([
            'subcategory_name' => 'required|unique:subcategories',
        ]);
        $formData['subcategory_slug'] = Str::slug($request->subcategory_name,'-');
        $notification = array('message' => 'SubCategory Add Successfully!','alert-type' => 'success');

        SubCategory::create($formData);
        return redirect()->route('subcategory.index')->with($notification);
    }
    public function edit($subcategory_id){
        $this->data['subcategory']         = SubCategory::findOrFail($subcategory_id);
        $this->data['categories'] = Category::all();
        $this->data['mode'] = 'edit'; 
        return view('admin.category.subcategory.edit',$this->data);
    }
    public function update(Request $request,$subcategory_id){
        $data = $request->all();
        $subcategory = SubCategory::findOrFail($subcategory_id);
        $subcategory->category_id = $data['category_id'];
        $subcategory->subcategory_name = $data['subcategory_name'];
        $subcategory->subcategory_slug = Str::slug($data['subcategory_name']);
        $subcategory->save();

        $notification = array('message' => 'SubCategory Updated Successfully!','alert-type' => 'success');
        return redirect()->route('subcategory.index')->with($notification);
    }
    public function destroy($subcategory_id){
        $subcategory = SubCategory::findOrFail($subcategory_id);
        $subcategory->delete();
        $notification = array('message' => 'SubCategory Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('subcategory.index')->with($notification);
    }
}
