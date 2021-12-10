<?php

namespace App\Http\Controllers\Courier;

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

        $order= $order->paginate(10);
        return view('courier.orders', compact('order'));
    }

    public function update_status($id)
    {
        $order = Order::find($id);
        $delivery_guys = Delivery_guy::where('courier_id',$order->courier_id)->get();

	    return view('courier.update_status', compact('order','delivery_guys'));
    }

    public function change_status(Request $request, $id)
    {
        $order = Order::find($id);

	    $order->update([
			'status'=> $request->status,
			'delivery_guy_id' => $request->delivery_guy_id,
	    ]);

	    return redirect(route('courier.orders'))->with(['success' => 'Order Status Updated']);
    }

}