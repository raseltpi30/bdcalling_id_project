<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Seo;
use App\Models\Smtp;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function seo(){
        $this->data['seo'] = DB::table('seos')->first();
        return view('admin.setting.seo',$this->data);
    }
    public function seoUpdate(Request $request, $id){
        $data = $request->all();
        $seo = Seo::findOrFail($id);
        $seo->meta_title = $data['meta_title'];
        $seo->meta_author= $data['meta_author'];
        $seo->meta_tag= $data['meta_tag'];
        $seo->meta_description= $data['meta_description'];
        $seo->meta_keyword= $data['meta_keyword'];
        $seo->google_verification= $data['google_verification'];
        $seo->google_analytics= $data['google_analytics'];
        $seo->alexa_verification= $data['alexa_verification'];
        $seo->save();

        $notification = array('message' => 'Seo Updated Successfully!','alert-type' => 'success');
        return redirect()->route('setting.seo')->with($notification);
    }
    public function smtp(){
        $this->data['smtp'] = DB::table('smtp')->first();
        return view('admin.setting.smtp',$this->data);
    }
    public function smtpUpdate(Request $request ,$id){
        $data = $request->all();
        $smtp = Smtp::findOrFail($id);
        $smtp->mailer = $data['mailer'];
        $smtp->host = $data['host'];
        $smtp->port = $data['port'];
        $smtp->user_name = $data['user_name'];
        $smtp->password = $data['password'];
        $smtp->save();
        $notification = array('message' => 'SMTP Updated Successfully!','alert-type' => 'success');
        return redirect()->route('setting.smtp')->with($notification);
    }
    public function website(){
        $this->data['setting'] = DB::table('settings')->first();
        $this->data['smtp'] = DB::table('smtp')->first();
        return view('admin.setting.website',$this->data);
    }
    public function websiteUpdate(Request $request, $setting_id){
        $data = $request->all();
        $setting = Setting::findOrFail($setting_id);
        
        //for logo 
        if($request->logo){
            $logo = $request->logo;
            $logoextension = $logo->getClientOriginalExtension();
            $logoname = 'logo'.'-'.time().'.'.$logoextension;
            if($logoextension === 'jpg' || $logoextension === 'png' || $logoextension === 'jpeg'){
                if(File::exists($request->old_logo)){
                    unlink($request->old_logo);
                }
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->logo);
                $image = $image->resize(320,180);
                $image->toJpeg(80)->save(base_path('public/files/website_setting/'.$logoname));
                $data['logo'] = 'files/website_setting/'.$logoname;
            }
            else{
                $notification = array('message' => 'Image Must Be JPG,JPEG Or PNG Format!','alert-type' => 'error');
                return redirect()->route('setting.website')->with($notification); 
            }
        }
        else{
            $data['logo'] = $request->old_logo;
        }
        // for favicon 
        if($request->favicon){
            $favicon = $request->favicon;
            $faviconextension = $favicon->getClientOriginalExtension();
            $faviconname = 'favicon'.'-'.time().'.'.$faviconextension;

                   
            if($faviconextension === 'jpg' || $faviconextension === 'png' || $faviconextension === 'jpeg'){
                if(File::exists($request->old_favicon)){
                    unlink($request->old_favicon);
                }
                               
                // using image intervention 
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->favicon);
                $image = $image->resize(32,32);
                $image->toJpeg(80)->save(base_path('public/files/website_setting/'.$faviconname));
                $data['favicon'] = 'files/website_setting/'.$faviconname;
            }
            else{
                $notification = array('message' => 'Image Must Be JPG,JPEG Or PNG Format!','alert-type' => 'error');
                return redirect()->route('setting.website')->with($notification); 
            }


            // simple image working 
            // if($photoextension === 'jpg' || $photoextension === 'png' || $photoextension === 'jpeg'){
            //     if(File::exists($request->old_favicon)){
            //         unlink($request->old_favicon);
            //     }
            //     // $photo->move('files/website_setting/',$photoname);      
            //     Image::make($photo)->resize(320,120)->save('files/website_setting/',$photoname);                 
            //     $data['favicon'] = 'files/website_setting/'.$photoname;
            // }
            // else{
            //     $notification = array('message' => 'Image Must Be JPG,JPEG Or PNG Format!','alert-type' => 'error');
            //     return redirect()->route('setting.website')->with($notification); 
            // }
        }
        else{
            $data['favicon'] = $request->old_favicon;
        }

        $setting->logo = $data['logo'];
        $setting->favicon = $data['favicon'];
        $setting->currency = $data['currency'];
        $setting->phone_one = $data['phone_one'];
        $setting->phone_two = $data['phone_two'];
        $setting->main_email = $data['main_email'];
        $setting->support_email = $data['support_email'];
        $setting->address = $data['address'];
        $setting->facebook = $data['facebook'];
        $setting->twitter = $data['twitter'];
        $setting->instagram = $data['instagram'];
        $setting->linkedin = $data['linkedin'];
        $setting->youtube = $data['youtube'];
        $setting->save();
        $notification = array('message' => 'Website Setting Updated Successfully!','alert-type' => 'success');
        return redirect()->route('setting.website')->with($notification);
    }
    public function PaymentGateway(){
        $aamarpay = DB::table('payment_gateway_bd')->first();
        $surjopay = DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl = DB::table('payment_gateway_bd')->skip(2)->first();

        return view('admin.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
    }
    public function AamarpayUpdate(Request $request){
        $upData = array();
        $upData['store_id'] = $request->store_id;
        $upData['signature_key'] = $request->signature_key;
        $upData['status'] = $request->status;

        DB::table('payment_gateway_bd')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'Aamarpay Payment Updated Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function surjopayUpdate(Request $request){
        $upData = array();
        $upData['store_id'] = $request->store_id;
        $upData['signature_key'] = $request->signature_key;
        $upData['status'] = $request->status;

        DB::table('payment_gateway_bd')->where('id',$request->id)->update($upData);
        $notification = array('message' => 'Surjopay Payment Updated Successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
