<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\District;
use App\Customer;
use Illuminate\Support\Str;
use Mail;
use App\Mail\CustomerRegisterMail;
use Hash;

class LoginController extends Controller
{
    public function loginForm()
    {
		if (auth()->guard('courier')->check()) return redirect(route('courier.home'));

        return view('courier.login');
    }


    public function login(Request $request)
	{
		$this->validate($request, [
	        'email' => 'required|email|exists:couriers,email',
	        'password' => 'required|string'
	    ]);
		
	    $auth = $request->only('email', 'password');
	    $auth['status'] = 1;
	    if (auth()->guard('courier')->attempt($auth)
		) {
			$out = new \Symfony\Component\Console\Output\ConsoleOutput();
			$out->writeln("Prra");
			return redirect()->intended(route('courier.home'));
	    }
	    return redirect()->back()->with(['error' => 'Wrong Email/Password']);
	}

	public function registerForm()
    {
		$provinces = Province::orderBy('created_at', 'DESC')->get();
		if (auth()->guard('customer')->check()) return redirect(route('ecommerce.index'));
		$n_carts = $this->getNCarts();
        return view('ecommerce.register', compact('n_carts','provinces'));
    }

	public function register(Request $request)
	{
	    $this->validate($request, [
	        'customer_name' => 'required|string|max:100',
	        'phone_number' => 'required',
			'email' => 'required|email',
			'password' => 'required|string',
	        'customer_address' => 'required|string',
	        'province_id' => 'required|exists:provinces,id',
	        'city_id' => 'required|exists:cities,id',
	        'district_id' => 'required|exists:districts,id'
	    ]);

		$customer = Customer::create([
			'name' => $request->customer_name,
			'email' => $request->email,
			'password' => $request->password,
			'phone_number' => $request->phone_number,
			'address' => $request->customer_address,
			'district_id' => $request->district_id,
			'activate_token' => Str::random(30),
			'status' => false
		]);

		Mail::to($request->email)->send(new CustomerRegisterMail($customer, $request->password));
		return redirect()->intended(route('front.index'));
	}
}