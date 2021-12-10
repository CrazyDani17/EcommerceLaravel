<?php

namespace App\Http\Controllers\Ecommerce;

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
		//Esto es para regresar al checkout si es que no te logueaste antes
		$links = session()->has('links') ? session('links') : [];
		$currentLink = request()->path();
		array_unshift($links, $currentLink);
		session(['links' => $links]);

		if (auth()->guard('customer')->check()) return redirect(route('front.index'));
		$n_carts = $this->getNCarts();
        return view('ecommerce.login', compact('n_carts'));
    }


    public function login(Request $request)
	{
		$this->validate($request, [
	        'email' => 'required|email|exists:customers,email',
	        'password' => 'required|string'
	    ]);
		
	    $auth = $request->only('email', 'password');
	    $auth['status'] = 1;
	    if (auth()->guard('customer')->attempt($auth)) 
		{
			if (count(session('links'))>=3){
				if (session('links')[2] == 'checkout') return redirect(route('front.checkout'));
			}
			return redirect()->intended(route('front.index'));
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

	public function dashboard()
	{
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			$customer_info = auth()->guard('customer')->user();
			return view('ecommerce.dashboard', compact('n_carts','user_name','customer_info'));
		}
	    return view('ecommerce.index', compact('n_carts'));
	}

	public function edit_profile()
	{
		$provinces = Province::orderBy('created_at', 'DESC')->get();
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			$customer_info = auth()->guard('customer')->user();
			$cities = City::where('province_id',$customer_info->district->city->province->id)->orderBy('created_at', 'DESC')->get();
			$districts = District::where('city_id',$customer_info->district->city->id)->orderBy('created_at', 'DESC')->get();
			return view('ecommerce.edit_customer', compact('n_carts','user_name','customer_info','provinces','cities','districts'));
		}
	    return view('ecommerce.index', compact('n_carts'));
	}

	public function edit_customer(Request $request)
	{
		
		$user_id = 0;
		if (auth()->guard('customer')->check()){
			$user_id = auth()->guard('customer')->user()->id;
		}
	   $this->validate($request, [
			'customer_name' => 'required|string|max:100',
			'phone_number' => 'required',
			'customer_address' => 'required|string',
			'province_id' => 'required|exists:provinces,id',
			'city_id' => 'required|exists:cities,id',
			'district_id' => 'required|exists:districts,id'
		]);

	    $customer = Customer::find($user_id);
	    $customer->update([
	        'name' => $request->customer_name,
			'phone_number' => $request->phone_number,
			'address' => $request->customer_address,
			'district_id' => $request->district_id,
	    ]);
	    return redirect(route('customer.dashboard'))->with(['success' => 'Profile Data Updated']);
	}

	public function destroy_account()
	{
		if (auth()->guard('customer')->check()){
			$user_id = auth()->guard('customer')->user()->id;
			$customer = Customer::find($user_id);
			$customer->delete();
		}
		return redirect(route('customer.login'));
	}

	public function restore_pass()
	{
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.restore_pass', compact('n_carts','user_name'));
		}
	    return view('ecommerce.index', compact('n_carts'));
	}

	public function restore_password(Request $request)
	{
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$customer = auth()->guard('customer')->user();
			if(Hash::check($request->current_password, $customer->password)){
				$customer->update(['password' => $request->new_password]);
				return redirect()->back()->with(['success' => "successful password reset"]);
			}
			else{
				return redirect()->back()->with(['error' => "It isn't the correct password"]);
			}
		}
		return view('ecommerce.index', compact('n_carts'));
		
	}

	

	public function logout()
	{
	    auth()->guard('customer')->logout();
	    return redirect(route('customer.login'));
	}


	private function getNCarts()
	{
	    $carts = json_decode(request()->cookie('dw-carts'), true);
	    $carts = $carts != '' ? $carts:[];
		$n_carts = collect($carts)->sum(function($q) {
	        return $q['qty'];
	    });
	    return $n_carts;
	}
}
