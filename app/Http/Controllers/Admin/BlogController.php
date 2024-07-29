<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

// for image intervention 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // all category showing method 
    public function index()
    {
        // return "new";
        $data=DB::table('blog_category')->get();  //query builder
        return view('admin.blog.index',compact('data'));
        
    }
    //store category
    public function store(Request $request)
    {
        $validated = $request->validate([
           'category_name' => 'required|max:55',
       ]);

        //query builder
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('blog_category')->insert($data);
         
        $notification=array('message' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        DB::table('blog_category')->where('id',$id)->delete();
        $notification=array('message' => 'Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        // return $id;
        $data = DB::table('blog_category')->where('id',$id)->first();
        return view('admin.blog.category_edit',compact('data'));
    } 

    public function update(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('blog_category')->where('id',$request->id)->update($data);
        $notification=array('message' => 'Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function blog(Request $request){
        if($request->ajax()){
            $imgurl = 'files/profile/rasel-raj.jpeg';
            $blog = DB::table('blogs')
                ->leftJoin('blog_category','blogs.blog_category_id','blog_category.id')
                ->select('blogs.*','blog_category.category_name')
                ->get();
            return DataTables::of($blog)
            ->editColumn('status',function($row){
                if ($row->status==1) {
                    return '<span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->editColumn('thumbnail',function($row){
                if($row->thumbnail != NULL){
                    return '<img src="'.asset('files/blog/'.$row->thumbnail).'"  height="30" width="30" >';
                }else{
                    return "thumbnail is empty";
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn='
                <a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                <a href="'.route('blog.delete',$row->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';                
                return $actionbtn; 	

            })
            ->rawColumns(['action','status','thumbnail'])
            ->make(true);
        }

        $blog = DB::table('blogs')->get();
        return view('admin.blog.blog_details',compact('blog'));
        
    }
    public function blogStore(Request $request){
        $formData = array();
        $formData['blog_category_id'] = $request->blog_category_id;
        $formData['title'] = $request->title;
        $formData['slug'] = Str::slug($request->title);
        $formData['description'] = $request->description;
        $formData['public_date'] = date('d-m-Y');
        $formData['tag'] = $request->tag;
        $formData['status'] = $request->status;
        $photo = $request->thumbnail;
        $photoname = $formData['slug'].'.'.$photo->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image->resize(800,600);
        $image->toJpeg(80)->save(base_path('public/files/blog/'.$photoname));
        $formData['thumbnail'] = $photoname;
        DB::table('blogs')->insert($formData);
        $notification=array('message' => 'Blog Created Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function blogEdit($id){
        $blog = DB::table('blogs')->where('id',$id)->first();
        return view('admin.blog.blog_edit',compact('blog'));
    }
    public function blogUpdate(Request $request){
        $upData = array();
        // return $request->all();
        $upData['blog_category_id'] = $request->blog_category_id;
        $upData['title'] = $request->title;
        $upData['slug'] = Str::slug($request->title);
        $upData['public_date'] = date('d-m-Y');
        $upData['description'] = $request->description;
        $upData['tag'] = $request->tag;
        $upData['status'] = $request->status;
        if($request->thumbnail){
            // return "ache";
            if(File::exists($request->old_thumbnail)){
                unlink($request->old_thumbnail);
            }
            $photo = $request->thumbnail;
            $photoname = $upData['slug'].'.'.$photo->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($photo);
            $image->toJpeg(500)->save(base_path('public/files/blog/'.$photoname));
            $upData['thumbnail'] = $photoname;

            DB::table('blogs')->where('id',$request->id)->update($upData);
            $notification=array('message' => 'Blog Updated Successfully!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        else{
            // return "nai";
            $upData['thumbnail'] = $request->old_thumbnail;
            DB::table('blogs')->where('id',$request->id)->update($upData);
            $notification = array('message' => 'Blog Updated Successfully!','alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
    public function destroyBlog($id){
        $blog = DB::table('blogs')->where('id',$id)->first();
        $image = $blog->thumbnail;
        if(FIle::exists('files/blog/'.$image)){
            unlink('files/blog/'.$image);
        };
        DB::table('blogs')->where('id',$id)->delete();
        $notification = array('message' => 'Blog Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('blog.index')->with($notification);
    }
}
