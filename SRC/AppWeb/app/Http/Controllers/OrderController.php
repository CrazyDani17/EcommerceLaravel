<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\District;
use App\Customer;
use App\Order;
use Illuminate\Support\Str;
use Mail;
use App\Mail\CustomerRegisterMail;
use DB;
use File;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::orderBy('created_at', 'DESC');
      
        if (request()->q != '') {
            $order = $order->where('invoice', 'LIKE', '%' . request()->q . '%');
        }

        $order= $order->paginate(10);
        return view('orders.index', compact('order'));
    }

}