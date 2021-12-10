<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Customer;

class HomeController extends Controller
{
    public function index()
    {
        $need_to_be_sent = $this->get_need_to_be_sent();
        $total_products = $this->get_total_products();
        return view('courier.home',compact('need_to_be_sent','total_products'));
    }

    function get_need_to_be_sent(){
        $today   =   date('Y-m-d');
        $need_to_be_sent = Order::where('created_at','like', '%'.$today.'%')->count();
        return $need_to_be_sent;
    }

    function get_total_products(){
        $today   =   date('Y-m-d');
        $need_to_be_sent = OrderDetail::where('created_at','like', '%'.$today.'%')->sum('qty');
        return $need_to_be_sent;
    }

}