<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Setting;
use App\Models\Webreview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function review(Request $request){
        //for customer review for product
        $validated = $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);
        $check = DB::table('reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
        if($check){
            $notification = array('message' => 'ALready You have a review with this product!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        $formData = $request->all();
        $formData['user_id'] = Auth::id();
        $formData['review_date']=date('d-m-Y');
        $formData['review_month']=date('F');
        $formData['review_year']=date('Y');
        Review::create($formData);

        $notification = array('message' => 'Review Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function addWishlist($id){
        //add wishlist item for customer
        if(Auth::check()){
            $check = DB::table('wishlists')->where('user_id',Auth::id())->where('product_id',$id)->first();
            if($check){
                $notification = array('message' => 'Product Already In the Wishlist!!','alert-type' => 'error');
                return redirect()->back()->with($notification);
                // return response()->json('Product Already In the Wishlist!');
            }
            else{
                $formData['user_id'] = Auth::id();
                $formData['date'] = date('Y-m-d');
                $formData['product_id'] = $id;
                DB::table('wishlists')->insert($formData);
                $notification = array('message' => 'Product Add To Wishlist Successfully!','alert-type' => 'success');
                return redirect()->back()->with($notification);                
            }
        }
        else{
            $notification = array('message' => 'Login Your  Account!!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
    public function quick($id){
        //quick view for product
        $product = Product::findOrFail($id);
        $setting = Setting::all()->first();
        return view('frontend.product.quick_view',compact('product','setting'));
    }
}
