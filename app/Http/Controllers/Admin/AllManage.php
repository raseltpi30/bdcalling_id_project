<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Custome;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class AllManage extends Controller
{
    //

    public function customerManage()
    {
        return view('admin.customer.index', [
            'customers' => Custome::all()
        ]);
    }
    public function customerStatus($id)
    {
        $customer = Custome::findOrFail($id);
        $customer->status = $customer->status == 1 ? 0 : 1;
        $customer->save();
        $notification = array('message' => 'Customer status updated successfully!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function bidManage()
    {
        // Fetch the latest bid for each product_id and customer_id combination
        $latestBids = Bid::select('bids.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM bids GROUP BY customer_id, property_id) as latest_bids'), 'bids.id', '=', 'latest_bids.id')
            ->orderBy('bids.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.bid.index', [
            'bids' => $latestBids
        ]);
    }
}
