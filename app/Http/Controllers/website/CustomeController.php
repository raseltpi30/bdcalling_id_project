<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Custome;
use Illuminate\Http\Request;
use Session;

class CustomeController extends Controller
{
    private $customer, $bid, $customer_id;
    public function registrationForm()
    {
        return view('website.customer.registration');
    }

    public function loginForm()
    {
        return view('website.customer.login');
    }

    public function saveCustomerInfo(Request $request)
    {
        Custome::saveInfo($request);
        // Session::put('customer_id', $this->customer->id);
        // Session::put('customer_name', $this->customer->fname.' '.$this->customer->lname);
        return redirect('/customer/login');
    }

    public function customerLoginCheck(Request $request)
    {
        Custome::loginCheck($request);
        // if (Session::get('product_id')) {
        //     $productId = Session::get('product_id');
        //     Session::forget(Session::get('product_id'));
        //     return  redirect('/product/details/' . $productId);
        // }
        return redirect('/');
    }

    public function logout()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');

        return redirect('/');
    }
}
