<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Mail\RecievedMail;
use Mail;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__order list
    public function index(Request $request)
    {
        if($request->ajax()){
            $query=DB::table('orders')->orderBy('id','DESC'); //it is query for orders
            //filtering with date
            if ($request->date){
                $order_date=date('d-m-Y',strtotime($request->date));
                $query->where('date',$order_date);
            }
            //filtering with payment type
            if ($request->payment_type) {
                $query->where('payment_type',$request->payment_type);
            }
            //filtering with status
            if ($request->status==0) {
                $query->where('status',0);
            }
            if ($request->status==1) {
                $query->where('status',1);
            }
            if ($request->status==2) {
                $query->where('status',2);
            }
            if ($request->status==3) {
                $query->where('status',3);
            }
            if ($request->status==4) {
                $query->where('status',4);
            }
            if ($request->status==5) {
                $query->where('status',5);
            }
            $product=$query->get();
            return DataTables::of($product)
            //status column edit 
                ->editColumn('status',function($row){
                    if ($row->status==0) {
                        return '<span class="badge badge-danger">Pending</span>';
                    }elseif($row->status==1){
                        return '<span class="badge badge-primary">Recieved</span>';
                    }elseif($row->status==2){
                        return '<span class="badge badge-info">Shipped</span>';
                    }elseif($row->status==3){
                        return '<span class="badge badge-success">Completed</span>';
                    }elseif($row->status==4){
                        return '<span class="badge badge-warning">Return</span>';
                    }elseif($row->status==5){
                        return '<span class="badge badge-danger">Cancel</span>';
                    }
                })
                //subtotal column edit
                ->editColumn('after_discount',function($row){
                    if($row->after_discount != 0){
                        return $row->after_discount;
                    }
                    else{
                        return $row->total;
                    }
                })
                ->addIndexColumn()   
                //for column add                  
                ->addColumn('action', function($row){
                    $abtn='
                    <a href="#" class="btn btn-primary btn-sm view" data-id="'.$row->id.'" data-toggle="modal" data-target="#viewModal" ><i class="fas fa-eye"></i></a>
                    <a href="#" data-id="'.$row->id.'" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a> 
                    <a href="'.route('admin.order.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                    </a>';
                    return $abtn;   
                })
                ->rawColumns(['action','status','after_discount'])
                ->make(true);       
        
        }
        $setting = DB::table('settings')->first();
        return view('admin.order.index',compact('setting'));
    }


    //__order edit
    public function edit($id){
        // return $id;
        $order=DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('order'));
    }

    //__update status
    public function updateStatus(Request $request)
    {
        $data=array();
        $data['c_name']=$request->c_name;
        $data['c_email']=$request->c_email;
        $data['c_address']=$request->c_address;
        $data['c_address']=$request->c_address;
        $data['status']=$request->status;

        if($request->status=='1'){
            Mail::to($request->c_email)->send(new RecievedMail($data));
        }
        
        DB::table('orders')->where('id',$request->id)->update($data);
        return response()->json('successfully cjanged status!');
    }


    //__view Order
    public function ViewOrder($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        $order_details=DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.order_details',compact('order','order_details'));
    }

    //__delete
    public function delete($id)
    {
       $order=DB::table('orders')->where('id',$id)->delete();
       $order_details=DB::table('order_details')->where('order_id',$id)->delete();
       $notification=array('message' => 'Order deleted!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    //__report index__//
    public function Reportindex(Request $request)
    {
         if ($request->ajax()) {
            $imgurl='public/files/product';

            $product="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               

            $product=$query->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge badge-danger">Pending</span>';
                        }elseif($row->status==1){
                            return '<span class="badge badge-primary">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge badge-info">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge badge-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge badge-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge badge-danger">Cancel</span>';
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);       
        }

        return view('admin.report.index');
    }

    //order print__
    public function ReportOrderPrint(Request $request)
    {
        if ($request->ajax()) {
            $order="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }     
            $order=$query->get();
       }

       return view('admin.report.print',compact('order'));
    }
}
