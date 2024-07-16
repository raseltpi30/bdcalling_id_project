<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Home()
    {
        // for customer home 
        $orders = DB::table('orders')->where('user_id',Auth::id())->get();
        $total_order = DB::table('orders')->where('user_id',Auth::id())->count();
        // $complete_order = DB::table('orders')->where('user_id',Auth::id())->where('status',2)->get();
        $complete_order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->count();
        $return_order = DB::table('orders')->where('user_id',Auth::id())->where('status',4)->count();
        $cancel_order = DB::table('orders')->where('user_id',Auth::id())->where('status',5)->count();
        // return $order;
        return view('home',compact('orders','total_order','complete_order','return_order','cancel_order'));
    }
    //for customer logout 
    public function CustomerLogout(){
        Auth::logout();
        $notification = array('message' => 'You are Logged Out!','alert-type' => 'success');
        return redirect()->route('index')->with($notification);
    }
    public function setting()
    {
        return view('user.setting');
    }
    //for customer password change
    public function PasswordChange(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
 
        $current_password=Auth::user()->password;  //login user password get 

        $oldpass=$request->old_password; //oldpassword get from input field
        $new_password=$request->password;  // newpassword get for new password
        if(Hash::check($oldpass,$current_password)) {  //checking oldpassword and currentuser password same or not
            $user=User::findorfail(Auth::id());    //current user data get
            $user->password=Hash::make($request->password); //current user password hasing
            $user->save();  //finally save the password
            Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
            $notification=array('message' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->to('/')->with($notification);
        }else{
            $notification=array('message' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
    public function MyOrder(){
        //for customer order list
        $orders = DB::table('orders')->orderBy('id','DESC')->get();
        return view('user.my_order',compact('orders'));
    }
    public function ViewOrder($id){
        //for customer order Details
        $order = DB::table('orders')->where('id',$id)->first();
        $order_details = DB::table('order_details')->where('order_id',$id)->get();
        return view('user.view_order',compact('order','order_details'));
    }
    // Review For website 
    public function WriteReview(){
        //for website review
        return view('user.write_review');
    }
    public function StoreReview(Request $request){
        //for store customer review for website
        $check = DB::table('webreviews')->where('user_id',Auth::id())->first();
        if($check){
            $notification = array('message' => 'Review Already Exist!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        else{
            $formData = array();
            $formData['user_id'] = Auth::id();
            $formData['name'] = $request->customer_name;
            $formData['review'] = $request->review;
            $formData['rating'] = $request->rating;
            $formData['review_date'] = date('d-m-Y');
            // return $formData;

            DB::table('webreviews')->insert($formData);
            // Jokhon ami db diye data insert korabo tokhon obossoi array akare data add korte hobe
            //ar model diye data add korale obossoi protected fillable a add korte hobe

            // Webreview::create($formData);          
            $notification = array('message' => 'Review Create Successfully!','alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
