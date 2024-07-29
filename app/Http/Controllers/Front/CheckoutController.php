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
        // $validated = $request->validate([
        //     'c_name' => 'required',
        //     'c_phone' => 'required|numeric|digits:11|',
        //     'c_country' => 'required|string',
        //     'c_address' => 'required',
        //     'c_email' => 'required|email',
        //     // 'c_extra_phone' => 'numeric|digits:11',
        // ]);
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

            // Mail::to($request->c_email)->send(new InvoiceMail($order));

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

            Cart::destroy();
            if (Session::has('coupon')) {
                  Session::forget('coupon');
            }
            $notification=array('message' => 'Successfully Order Placed!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
        elseif($request->payment_type == "Aamarpay"){
            $aamarpay=DB::table('payment_gateway_bd')->first();
             if($aamarpay->store_id==NULL){
                 $notification=array('messege' => 'Please setting your payment gateway', 'alert-type' => 'error');
                 return redirect()->back()->with($notification);
            }else{
                if($aamarpay->status==1){

                    // return 1;
                    $url = 'https://secure.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
                }else{
                    // return 2;
                    $url = 'https://sandbox.aamarpay.com/request.php';
                }
                $decimals = 1-1;
                $decimalSeperator = '';
                $thousandSeperator = '';
                $amount = Cart::total($decimals, $decimalSeperator, $thousandSeperator);

                $fields = array(
                    'store_id' => $aamarpay->store_id, //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                    'amount' => $amount, //transaction amount
                    'payment_type' => 'VISA', //no need to change
                    'currency' => 'BDT',  //currenct will be USD/BDT
                    'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
                    'cus_name' => $request->c_name,  //customer name
                    'cus_email' => $request->c_email, //customer email address
                    'cus_add1' => $request->c_address,  //customer address
                    'cus_add2' => 'Mohakhali DOHS', //customer address
                    'cus_city' => $request->c_city,  //customer city
                    'cus_state' => 'Dhaka',  //state
                    'cus_postcode' => $request->c_zipcode, //postcode or zipcode
                    'cus_country' => $request->c_country,  //country
                    'cus_phone' => $request->c_phone, //customer phone number
                    'cus_fax' => $request->c_extra_phone,  //fax
                    'ship_name' => 'ship name', //ship name
                    'ship_add1' => 'House B-121, Road 21',  //ship address
                    'ship_add2' => 'Mohakhali',
                    'ship_city' => 'Dhaka', 
                    'ship_state' => 'Dhaka',
                    'ship_postcode' => '1212', 
                    'ship_country' => 'Bangladesh',
                    'desc' => 'payment description', 
                    'success_url' => route('success'), //your success route
                    'fail_url' => route('fail'), //your fail route
                    'cancel_url' => route('cancel'), //your cancel url
                    'opt_a' => $request->c_country,  //subtotal
                    'opt_b' => $request->c_city, //payment_type
                    'opt_c' => $request->c_phone,  //customer phone
                    'opt_d' => $request->c_address,
                    'signature_key' => $aamarpay->signature_key); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key
    
                    $fields_string = http_build_query($fields);
             
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_VERBOSE, true);
                    curl_setopt($ch, CURLOPT_URL, $url);  
              
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));  
                    curl_close($ch); 
    
                    $this->redirect_to_merchant($url_forward);
                }
        }
    }
    
    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php   
        exit;
    } 


    //__paymentgateway extra method
    public function success(Request $request){
            return $request->all();
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

            return $order;
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

            // Mail::to($request->c_email)->send(new InvoiceMail($order));

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

            Cart::destroy();
            if (Session::has('coupon')) {
                  Session::forget('coupon');
            }
            $notification=array('message' => 'Successfully Order Placed!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);

    }

    public function fail(Request $request){
        return $request;
    }
}
