<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Mail\CustomerRegisterMail;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\City;
use App\Customer;
use App\District;
use App\Product;
use App\Order;
use App\OrderDetail;
use DB;
use Mail;


class CartController extends Controller
{
    public function addToCart(Request $request)
	{
	    $this->validate($request, [
	        'product_id' => 'required|exists:products,id',
	        'qty' => 'required|integer'
	    ]);

	    $carts = json_decode($request->cookie('dw-carts'), true); 
	  
	    if ($carts && array_key_exists($request->product_id, $carts)) {
	        $carts[$request->product_id]['qty'] += $request->qty;
	    } else {
	        $product = Product::find($request->product_id);
	        $carts[$request->product_id] = [
	            'qty' => $request->qty,
	            'product_id' => $product->id,
	            'product_name' => $product->name,
	            'product_price' => $product->price,
	            'product_image' => $product->image
	        ];
	    }

	    $cookie = cookie('dw-carts', json_encode($carts), 2880);
	    return redirect()->back()->cookie($cookie);
	}

	public function listCart()
	{
	    $carts = $this->getCarts();
	    $subtotal = collect($carts)->sum(function($q) {
	        return $q['qty'] * $q['product_price'];
	    });
		$n_carts = collect($carts)->sum(function($q) {
	        return $q['qty'];
	    });
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.cart', compact('carts', 'subtotal','n_carts','user_name'));
		}
	    return view('ecommerce.cart', compact('carts', 'subtotal','n_carts'));
	}

	public function updateCart(Request $request)
	{
	    $carts = $this->getCarts();
	    foreach ($request->product_id as $key => $row) {
	        if ($request->qty[$key] == 0) {
	            unset($carts[$row]);
	        } else {
	            $carts[$row]['qty'] = $request->qty[$key];
	        }
	    }
	    $cookie = cookie('dw-carts', json_encode($carts), 2880);
	    return redirect()->back()->cookie($cookie);
	}

	private function getCarts()
	{
	    $carts = json_decode(request()->cookie('dw-carts'), true);
	    $carts = $carts != '' ? $carts:[];
	    return $carts;
	}

	public function checkout()
	{
	    $carts = $this->getCarts();

		$subtotal = 0;
		
		foreach ($carts as $cart){
			$subtotal += $cart['qty'] * $cart['product_price'];
		}

		$n_carts = collect($carts)->sum(function($q) {
	        return $q['qty'];
	    });

		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			$user_information = auth()->guard('customer')->user();
			return view('ecommerce.checkout', compact('carts', 'subtotal','n_carts','user_name','user_information'));
		}
		//Esto es para volver atrás nuevamente si no está logueado
		$links = session()->has('links') ? session('links') : [];
		$currentLink = request()->path();
		array_unshift($links, $currentLink);
		session(['links' => $links]);
	    return view('ecommerce.checkout', compact('carts', 'subtotal','n_carts'));
	}

	public function checkoutFinish($invoice)
	{
	    $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
		$n_carts = 0;
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.checkout_finish', compact('order','n_carts','user_name'));
		}
	    return view('ecommerce.checkout_finish', compact('order','n_carts'));
	}

	public function getCity()
	{
	    $cities = City::where('province_id', request()->province_id)->get();
	    return response()->json(['status' => 'success', 'data' => $cities]);
	}

	public function getDistrict()
	{
	    $districts = District::where('city_id', request()->city_id)->get();
	    return response()->json(['status' => 'success', 'data' => $districts]);
	}
}
