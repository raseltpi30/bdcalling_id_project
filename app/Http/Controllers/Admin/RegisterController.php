<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function adminRegister(){
       return view('auth.admin_register');
    }
    public function adminStore(Request $request){

        $data = array();
        
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['password'] = Hash::make($request->password);

        User::create($data);
        $notification = array('message' => 'Admin Created Successfully!','alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
}
