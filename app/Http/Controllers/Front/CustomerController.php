<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// for image intervention 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function CustomerLogin(Request $request)
    {
        // for customer login
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $request->email,'password' => $request->password))){
            if(auth()->user()->is_admin == 1){
                Auth::logout();
                $notification = array('message' => 'You Are Not A Admin!','alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
            else{
                $notification = array('message' => 'You are Back!','alert-type' => 'success');
                return redirect()->back()->with($notification);
            }
        }
        else{
            $notification = array('message' => 'Invalid Email Or Password!','alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
    public function Register(){
        return view('user.register');
    }
    public function CustomerRegister(Request $request){
        //for customer register
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required','min:6','confirmed'],
        ]);  
        $formData = array();
        $formData['name'] = $request->name;
        $formData['email'] = $request->email;
        $formData['phone'] = $request->phone;
        $formData['password'] = $request->password;
        $formData['password'] = Hash::make($request->password);
        $formData['created_at'] = date('Y-m-d');
        $formData['updated_at'] = date('Y-m-d');
        if($request->profile_picture){
            $photo = $request->profile_picture;
            $photoname =Str::slug($request->name).'.'.$photo->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($photo);
            $image->resize(170,150);
            $image->toJpeg(80)->save(base_path('public/files/profile/'.$photoname));
            $formData['profile_picture'] = $photoname;
            DB::table('users')->insert($formData);
            $notification = array('message' => 'Registration Successfully!','alert-type' => 'success');
            return redirect()->route('index')->with($notification);
        }
        else{
            DB::table('users')->insert($formData);
            $notification = array('message' => 'Registration Successfully!','alert-type' => 'success');
            return redirect()->route('index')->with($notification);
        }
    }
}