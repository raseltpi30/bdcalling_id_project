<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if ($request->ajax()) {
            $this->data = Coupon::all();
    		return DataTables::of($this->data)
    				->addIndexColumn()
    				->addColumn('action', function($row){

    					$actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="'.route('coupon.delete',['coupon_id'=> $row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        $this->data = Coupon::all();
        return view('admin.offer.coupon.index',$this->data);
    }
    public function store(Request $request){
        $formData = $request->all();
        Coupon::create($formData);
        $notification = array('message' => 'Coupon Created Successfully!','alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }
    public function edit($coupon_id){
        $this->data['coupon'] = Coupon::findOrFail($coupon_id);
        return view('admin.offer.coupon.edit',$this->data);
        
    }
    public function update(Request $request,$coupon_id){
        $updata = $request->all();
        $coupon = Coupon::findOrFail($coupon_id);
        $coupon->coupon_code = $updata['coupon_code'];
        $coupon->type = $updata['type'];
        $coupon->amount = $updata['amount'];
        $coupon->valid_date = $updata['valid_date'];
        $coupon->status = $updata['status'];

        $coupon->save();
        $notification = array('message' => 'Coupon Updated Successfully!','alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }
    public function destroy($coupon_id){
        $coupon = Coupon::findOrFail($coupon_id);
        $coupon->delete();
        $notification = array('message' => 'Coupon Delted Successfully!','alert-type' => 'success');
        return redirect()->route('coupon.index')->with($notification);
    }
}
