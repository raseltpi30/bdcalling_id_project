<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;

use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(){
        if(!Auth::check()){
            $notification = array('message' => 'Login Your Account!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        else{
            $content = Cart::content();
            return view('frontend.cart.checkout',compact('content'));
        }
    }
    public function ApplyCoupon(Request $request){
        $check = DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if($check){
            if(strtotime(date('Y-m-d')) <= strtotime($check->valid_date)){
                $decimals = 1-1;
                $decimalSeperator = '';
                $thousandSeperator = '';
                session::put('coupon',[
                    'name'=>$check->coupon_code,
                    'discount'=>$check->amount,
                    'after_discount'=> Cart::total($decimals, $decimalSeperator, $thousandSeperator)-$check->amount,
                 ]);
                 $notification=array('message' => 'Coupon Applied!', 'alert-type' => 'success');
                 return redirect()->back()->with($notification);
            }
            else{
                $notification = array('message' => 'Coupon Date is Expired!','alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        }
        else{
            $notification = array('message' => 'Coupon is Invalid!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
    public function RemoveCoupon(){
        if (Session::has('coupon')) {
            Session::forget('coupon');
            $notification = array('message' => 'Coupon Remove Successfully!','alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
    public function OrderPlace(Request $request){
        if($request->payment_type == "Hand Cash"){
            $order=array();
            $order['user_id']=Auth::id();
            $order['c_name']=$request->c_name;
            $order['c_phone']=$request->c_phone;
            $order['c_country']=$request->c_country;
            $order['c_address']=$request->c_address;
            $order['c_email']=$request->c_email;
            $order['c_zipcode']=$request->c_zipcode;
            $order['c_extra_phone']=$request->c_extra_phone;
            $order['c_city']=$request->c_city;
            if(Session::has('coupon')){
                $order['subtotal']=Cart::subtotal();
                $order['coupon_code']=Session::get('coupon')['name'];
                $order['coupon_discount']=Session::get('coupon')['discount'];
                $order['after_discount']=Session::get('coupon')['after_discount'];
            }else{
                $order['subtotal']=Cart::subtotal();
                
            }
            $order['total']=Cart::total();
            $order['payment_type']=$request->payment_type;
            $order['tax']=0;
            $order['shipping_charge']=0;
            $order['order_id']=rand(10000,900000);
            $order['status']=0;
            $order['date']=date('d-m-Y');
            $order['month']=date('F');
            $order['year']=date('Y');
            
            $order_id=DB::table('orders')->insertGetId($order);

            Mail::to($request->c_email)->send(new InvoiceMail($order));

            $content=Cart::content();
            $details=array();
            foreach($content as $row){                
                $details['order_id']=$order_id;
                $details['product_id']=$row->id;
                $details['product_name']=$row->name;
                $details['color']=$row->options->color;
                $details['size']=$row->options->size;
                $details['quantity']=$row->qty;
                $details['single_price']=$row->price;
                $details['subtotal_price']=$row->price*$row->qty;
                DB::table('order_details')->insert($details);
            }

            // Cart::destroy();
            // if (Session::has('coupon')) {
            //       Session::forget('coupon');
            // }
            $notification=array('message' => 'Successfully Order Placed!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
