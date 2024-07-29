<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function blogList($id){
        $blog_category = DB::table('blog_category')->where('id',$id)->first();
        $blog_list = DB::table('blogs')->where('blog_category_id',$id)->get();
        // return $blog_list;
        return view('frontend.blog.index',compact('blog_category','blog_list'));
    }
    public function singleBlog($slug){
        $single_blog = DB::table('blogs')->where('slug',$slug)->first();
        $related_blog = DB::table('blogs')->where('blog_category_id',$single_blog->blog_category_id)->limit(3)->get();
        // return $related_blog;
        return view('frontend.blog.single',compact('single_blog','related_blog'));
    }
}
