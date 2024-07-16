<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;
// for image intervention 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function OpenTicket(){
        $tickets = DB::table('tickets')->where('user_id',Auth::id())->get();
        // return $tickets;
        return view('user.ticket',compact('tickets'));
    }
    public function NewTicket(){
        return view('user.new_ticket');
    }
    public function StoreTicket(Request $request){
        $validate = $request->validate([
            'subject' => 'required',
        ]);
        $formData = array();
        $formData['user_id'] = Auth::id();
        $formData['subject'] = $request->subject;
        $formData['priority'] = $request->priority;
        $formData['service'] = $request->service;
        $formData['message'] = $request->message;
        $formData['date'] = date('d-m-Y');

        if($request->image){
            $photo = $request->image;
            $photoname = Str::slug($formData['subject']).'-'.uniqid().'.'.$photo->getClientOriginalExtension();
            $manager = new ImageManager(new Driver);
            $image = $manager->read($photo);
            $image->resize(600,350);
            $image->toJpeg(80)->save(base_path('public/files/ticket/'.$photoname));
            $formData['image'] = $photoname;
        }
        DB::table('tickets')->insert($formData);
        $notification = array('message' => 'Ticket Created Successfully!','alert-type' => 'success');
        return redirect()->route('open.ticket')->with($notification);
    }
    public function ShowTicket($id){
        $ticket = DB::table('tickets')->where('id',$id)->first();
        return view('user.show_ticket',compact('ticket'));
    }
}
