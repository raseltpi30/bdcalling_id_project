<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        // if($request->ajax()){
        //     $data = DB::table('child_categories')->leftjoin('categories','child_categories.category_id','categories.id')->leftjoin('subcategories','child_categories.subcategory_id','subcategories.id')->select('child_categories.*','categories.category_name','subcategories.subcategory_name')->get();
        //     // $data = DB::table('categories')
        //     // ->leftJoin('subcategories', 'categories.id', '=', 'subcategories.category_id')
        //     // ->select('subcategories.category_id','categories.category_name')
        //     // ->get();
        //     // $data = DB::table('subcategories')
        //     // ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.id')->select('subcategories.category_id','categories.category_name')
        //     // ->get();
            
        //     return $data;
        // }
        if ($request->ajax()) {
    		$this->data=DB::table('child_categories')->leftJoin('categories','child_categories.category_id','categories.id')->leftJoin('subcategories','child_categories.subcategory_id','subcategories.id')
    		->select('categories.category_name','subcategories.subcategory_name','child_categories.*')->get();

    		return DataTables::of($this->data)
    				->addIndexColumn()
    				->addColumn('action', function($row){

    					$actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="'.route('childcategory.delete',['childcategory_id'=> $row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        $this->data['category'] = Category::all();
        return view('admin.category.childcategory.index',$this->data);
    }
    public function store(Request $request){
        $cat = SubCategory::all()->where('id',$request->subcategory_id)->first();
        $formData = $request->all();
        $formData['category_id'] = $cat->category_id;
        $formData['childcategory_slug'] = Str::slug($request->childcategory_name,'-');
        $this->data = ChildCategory::create($formData);

        $notification = array('message' => 'ChildCategory Created Successfully!','alert-type' => 'success');
        return redirect()->route('childcategory.index')->with($notification);        
    }
    public function destroy($childcategory_id){
        $childcategory = ChildCategory::findOrFail($childcategory_id);
        $childcategory->delete();
        $notification = array('message' => 'ChildCategory Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('childcategory.index')->with($notification);
    }

    public function edit($childcategory_id){
        $category = DB::table('categories')->get();
        $data = ChildCategory::all()->where('id',$childcategory_id)->first();
        return view('admin.category.childcategory.edit',compact('data','category'));

        return $data;
    }

    public function update(Request $request){
        $cat = SubCategory::all()->where('id',$request->subcategory_id)->first();
        $upData['category_id'] = $cat->category_id;
        $upData['subcategory_id'] = $request->subcategory_id;
        $upData['childcategory_name'] = $request->childcategory_name;
        $upData['childcategory_slug'] = Str::slug($request->childcategory_name);

        DB::table('child_categories')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'ChildCategory Updated Successfully!','alert-type' => 'success');
        return redirect()->route('childcategory.index')->with($notification);  
    }
}
