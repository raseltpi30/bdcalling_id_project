<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request){
        // cart add item 
        $product = Product::findOrFail($request->id);
        Cart::add([
        'id' => $product->id,
        'name' => $product->name,
        'qty' => $request->qty, 
        'price' => $request->price,
        'options' => ['size' => $request->size,'thumbnail' => $product->thumbnail,'color' => $request->color],
        ]);
    return response()->json('Product Added on cart!');
    }
    //all cart list
    public function AllCart()
    {
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        return response()->json($data);
    }
    public function MyCart()
    {
        $content = Cart::content();
        return view('frontend.cart.cart',compact('content'));
    }
    public function EmptyCart()
    {
        Cart::destroy();
        $notification = array('message' => 'Cart Clear!','alert-type' => 'success');
        return redirect()->route('home')->with($notification);
    }
    public function RemoveCart($rowId){
        Cart::remove($rowId);
        return response()->json("success!");
    }
    public function UpdateQty($rowId,$qty){
        if($qty == 1){
            return response()->json('Quantity Must Be 1 Or More than 1!');
        }else{
            Cart::update($rowId,['qty'=>$qty]);
            return response()->json('Quantity Updated Successfully!');
        }
       
    }
    public function ColorUpdate($rowId,$color){
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $size = $product->options->size;
        Cart::update($rowId,['options' => ['color' => $color,'thumbnail' => $thumbnail,'size' => $size]]);
        return response()->json('Color Updated Successfully!');
    }
    public function SizeUpdate($rowId,$size){
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $color = $product->options->color;
        Cart::update($rowId,['options' => ['color' => $color,'thumbnail' => $thumbnail,'size' => $size]]);
        return response()->json('Size Updated Successfully!');
    }


    //wishlist
    public function wishlist(){
        $wishlist = DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.name','products.slug','products.thumbnail','wishlists.*')->where('wishlists.user_id',Auth::id())->get();
        // return $wishlist;
        return view('frontend.cart.wishlist',compact('wishlist'));
    }
    public function RemoveWishlist($id){
        DB::table('wishlists')->where('id',$id)->delete();
        $notification = array('message' => 'Wishlist Item Deleted Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function EmptyWishlist(){
        DB::table('wishlists')->where('user_id',Auth::id())->delete();
        $notification = array('message' => 'Wishlist Clear!','alert-type' => 'success');
        return redirect()->route('home')->with($notification);
    }
}
