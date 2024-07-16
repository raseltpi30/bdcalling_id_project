<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if ($request->ajax()) {
            $this->data = Warehouse::all();
    		return DataTables::of($this->data)
    				->addIndexColumn()
    				->addColumn('action', function($row){

    					$actionbtn='<a href="#" class="btn btn-info btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="'.route('warehouse.delete',['warehouse_id'=> $row->id]).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                      	</a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        $this->data = Warehouse::all();
        return view('admin.category.warehouse.index',$this->data);
    }
    public function store(Request $request){
        $formData = $request->all();
        $validated = $request->validate([
            'warehouse_name' => 'required|string',
            'warehouse_phone' => 'required|numeric',
        ]);
        Warehouse::create($formData);

        $notification = array('message' => 'Warehouse Created Successfully!','alert-type' => 'success');
        return redirect()->route('warehouse.index')->with($notification);
    }
    public function edit($id){
        $data = DB::table('warehouses')->where('id',$id)->first();
        return view('admin.category.warehouse.edit',compact('data'));
    }
    public function update(Request $request,$warehouse_id){
        $updata = $request->all();
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse->warehouse_name = $updata['warehouse_name'];
        $warehouse->warehouse_address = $updata['warehouse_address'];
        $warehouse->warehouse_phone = $updata['warehouse_phone'];

        $warehouse->save();
        $notification = array('message' => 'Warehouse Updated Successfully!','alert-type' => 'success');
        return redirect()->route('warehouse.index')->with($notification);

    }
    public function destroy($warehouse_id){
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $warehouse->delete();
        $notification = array('message' => 'Warehouse Deleted Successfully!','alert-type' => 'success');
        return redirect()->route('warehouse.index')->with($notification);
    }
}
