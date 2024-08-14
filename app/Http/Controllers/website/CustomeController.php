<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Custome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomeController extends Controller
{
    private $customer, $bid, $customer_id;
    public function registrationForm()
    {
        return view('website.customer.registration');
    }

    public function saveCustomerInfo(Request $request)
    {
        Custome::saveInfo($request);
        // Session::put('customer_id', $this->customer->id);
        // Session::put('customer_name', $this->customer->fname.' '.$this->customer->lname);
        $notification = array('message' => 'Customer Created Successfully!','alert-type' => 'success');
        return redirect()->route('customer.login')->with($notification);

    }

    public function loginForm()
    {
        return view('website.customer.login');
    }

    public function customerLoginCheck(Request $request)
    {
        Custome::loginCheck($request);
        // if (Session::get('product_id')) {
        //     $productId = Session::get('product_id');
        //     Session::forget(Session::get('product_id'));
        //     return  redirect('/product/details/' . $productId);
        // }

        $notification = array('message' => 'Login Successfully!','alert-type' => 'success');
        return redirect()->route('home')->with($notification);
    }

    public function logout()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');

        $notification = array('message' => 'Logout Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function blog(){
        return view('website.home.blog');
    }
    public function about(){
        return view('website.home.about');
    }
}
