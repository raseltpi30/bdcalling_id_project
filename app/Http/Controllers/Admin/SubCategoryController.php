<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $subcategory = DB::table('subcategories')
                ->leftJoin('categories','subcategories.category_id','categories.id')
                ->select('subcategories.*','categories.category_name')->get();

            return DataTables::of($subcategory)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('subcategory.delete',['subcategory_id'=> $row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                </a>';
                
                return $actionbtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $subcategory = SubCategory::all();
        $category = Category::all();
        return view('admin.category.subcategory.index',compact('category','subcategory'));
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
    public function edit($id){
        $this->data['subcategory']         = SubCategory::findOrFail($id);
        $this->data['categories'] = Category::all();
        return view('admin.category.subcategory.edit',$this->data);
    }
    public function update(Request $request){
        // return $request->id;
        $data = $request->all();
        $subcategory = SubCategory::findOrFail($request->id);
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
