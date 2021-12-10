<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $get_earning_day = $this->get_earning_day();
        $earning_day = number_format($get_earning_day, 2, '.', '');
        $new_customers = $this->get_new_customers();
        $need_to_be_sent = $this->get_need_to_be_sent();
        $total_products = $this->get_total_products();
        return view('home',compact('earning_day','new_customers','need_to_be_sent','total_products'));
    }

    function get_earning_day(){
        $today   =   date('Y-m-d');
        $earning_day = Order::where('created_at','like', '%'.$today.'%')->sum('subtotal');
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
		$out->writeln($earning_day);
        return $earning_day;
    }

    function get_new_customers(){
        $today   =   date('Y-m-d');
        $new_customers = Customer::where('created_at','like', '%'.$today.'%')->count();
        return $new_customers;
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
