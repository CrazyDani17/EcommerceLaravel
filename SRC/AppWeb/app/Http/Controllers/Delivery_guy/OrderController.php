<?php

namespace App\Http\Controllers\Delivery_guy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\District;
use App\Customer;
use App\Order;
use App\Delivery_guy;
use Illuminate\Support\Str;
use Mail;
use App\Mail\CustomerRegisterMail;
use DB;
use File;
use App\Jobs\ProductJob;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::orderBy('created_at', 'DESC');
      
        if (request()->q != '') {
            $order = $order->where('invoice', 'LIKE', '%' . request()->q . '%');
        }

        if (auth()->guard('delivery_guy')->check()){
			$user_id = auth()->guard('delivery_guy')->user()->id;
            $order=$order->where('delivery_guy_id',$user_id);
		}

        $order= $order->paginate(10);
        return view('delivery_guy.orders', compact('order'));
    }

    /*public function update_status($id)
    {
        $order = Order::find($id);

	    return view('delivery_guy.update_status', compact('order'));
    }*/

    public function change_status_on_the_way($id)
    {
        $order = Order::find($id);

	    $order->update([
			'status'=> 'on_the_way'
	    ]);

	    return redirect(route('delivery_guy.orders'))->with(['success' => 'Order Status Updated']);
    }


    public function change_status_ready_for_pick_up($id)
	{
	    $order = Order::find($id);

	    $order->update([
			'status'=> 'ready_for_pick_up'
	    ]);

	    return redirect(route('delivery_guy.orders'))->with(['success' => 'Order Status Updated']);
	}

}