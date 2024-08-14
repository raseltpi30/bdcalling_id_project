<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function admin(){
        return view('admin.home');
    }
    public function logout(){
        Auth::logout();
        $notification = array('message' => 'You are Logged Out!','alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
    public function passwordChange(){
        return view('admin.profile.password_change');
    }
    public function passwordUpdate(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $current_password = Auth::user()->getAuthPassword();
        $old_password = $request->old_password;
        $new_password = $request->password;

        if(Hash::check($old_password,$current_password)){
            $user = User::FindOrFail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification = array('message' => 'Password Changed Successfully!','alert-type' => 'success');
            return redirect()->route('admin.login')->with($notification);
        }else{
            $notification = array('message' => 'Password Do Not Match!','alert-type' => 'error');
            return redirect()->route('admin.password.change')->with($notification);
        }
    }

}
