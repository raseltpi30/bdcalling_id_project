<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Review;
use App\Models\Setting;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class IndexController extends Controller
{
    //for index page
    public function index(){
        $category = Category::all();
        $brand = DB::table('brands')->inRandomOrder()->limit(12)->get();
        $home_category = Category::where('homepage',1)->orderBy('id','ASC')->limit(4)->get();
        $setting = Setting::all()->first();
        $bannerproduct = Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured = Product::where('status',1)->where('featured',1)->limit(10)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->limit(10)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(10)->get();
        $review = DB::table('webreviews')->where('status',1)->orderBy('id','DESC')->limit(10)->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(10)->get();        
        $today_deal = Product::where('status',1)->where('today_deal',1)->limit(4)->get();
        return view('frontend.index',compact('category','brand','bannerproduct','setting','featured','popular_product','review','trendy_product','home_category','random_product','today_deal'));
    }
    public function productDetails($slug){
        //for productdetails page
        $category = Category::all();
        $setting = Setting::all()->first();
        $product = Product::where('slug',$slug)->first();
        Product::where('slug',$slug)->increment('product_views');
        $review = Review::where('product_id',$product->id)->orderBy('id','DESC')->take('6')->get();
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        return view('frontend.product.product_details',compact('category','setting','product','review','related_product'));
    }
    public function CategoryWiseProduct($id){
        //for categoryWise product
        $category = Category::where('id',$id)->first();
        $subcategory = SubCategory::where('category_id',$id)->get();
        $products = Product::where('category_id',$id)->get();
        $brand = Brand::all();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(10)->get();   
        return view('frontend.product.categorywise_product',compact('category','subcategory','products','brand','random_product'));
    }
    public function SubCategoryWiseProduct($id){
        //for subcategoryWise product
        $subcategory = SubCategory::where('id',$id)->first();
        $childcategory = ChildCategory::where('subcategory_id',$id)->get();
        $products = Product::where('subcategory_id',$id)->get();
        $brand = Brand::all();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(10)->get();   
        return view('frontend.product.subcategorywise_product',compact('subcategory','childcategory','products','brand','random_product'));
    }
    public function ChildCategoryWiseProduct($id){
        //for childcategoryWise product
        $category = Category::all();
        $childcategory = ChildCategory::where('id',$id)->first();
        // return $childcategory;
        $products = Product::where('childcategory_id',$id)->get();
        $brand = Brand::all();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(10)->get(); 
        return view('frontend.product.childcategorywise_product',compact('category','childcategory','products','brand','random_product'));
    }
    public function BrandWiseProduct($id){   
        //for brandWise product     
        $category = Category::all();
        $brand = Brand::where('id',$id)->first();
        $brands = Brand::all();
        $products = Product::where('brand_id',$id)->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(10)->get();   
        return view('frontend.product.brandwise_product',compact('category','brand','brands','products','random_product'));
    }
    public function ViewPage($page_slug){
        // for other pages
        $page = DB::table('pages')->where('page_slug',$page_slug)->first();
        // return $page;
        return view('frontend.page.page',compact('page'));
    }
    public function Newsletter(Request $request){
        //for newsletter
        $email = $request->email;
        $check = DB::table('newsletters')->where('email',$email)->first();
        if($check){
            $notification=array('message' => 'Email Already Exist!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        else{
            $data = array();
            $data['email'] = $request->email;
            DB::table('newsletters')->insert($data);
            $notification=array('message' => 'Thanks for subscribe!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
    public function OrderTracking(){
        return view('frontend.order.tracking');
    }
    public function CheckOrder(Request $request){
        $check = DB::table('orders')->where('order_id',$request->order_id)->first();
        if($check){
            $order = DB::table('orders')->where('order_id',$request->order_id)->first();
            $order_details = DB::table('order_details')->where('order_id',$order->id)->get();
            return view('frontend.order.order_details',compact('order','order_details'));
        }
        else{
            $notification = array('message' => 'Invalid OrderId Try Again!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
