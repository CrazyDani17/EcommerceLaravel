<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\District;
use App\Customer;
use Illuminate\Support\Str;
use Mail;
use App\Mail\CustomerRegisterMail;
use DB;
use File;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $customer = $customer->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $customer= $customer->paginate(10);
        return view('customers.index', compact('customer'));
    }

	public function edit($id)
	{
	    $customer = Customer::find($id);
	    $provinces = Province::orderBy('created_at', 'DESC')->get();
		$cities = City::where('province_id',$customer->district->city->province->id)->orderBy('created_at', 'DESC')->get();
		$districts = District::where('city_id',$customer->district->city->id)->orderBy('created_at', 'DESC')->get();
	    return view('customers.edit', compact('customer', 'provinces','cities','districts'));
	}

	public function update(Request $request, $id)
	{
	   $this->validate($request, [
			'customer_name' => 'required|string|max:100',
			'phone_number' => 'required',
			'status' => 'required',
			'customer_address' => 'required|string',
			'province_id' => 'required|exists:provinces,id',
			'city_id' => 'required|exists:cities,id',
			'district_id' => 'required|exists:districts,id'
		]);

	    $customer = Customer::find($id);
	    $customer->update([
	        'name' => $request->customer_name,
			'phone_number' => $request->phone_number,
			'status'=> $request->status,
			'address' => $request->customer_address,
			'district_id' => $request->district_id,
	    ]);
	    return redirect(route('customer.index'))->with(['success' => 'Customer Data Updated']);
	}

	public function destroy($id)
	{
	    $customer = Customer::find($id);
	    $customer->delete();
	    return redirect(route('customer.index'))->with(['success' => 'Customer Has Been Removed']);
	}

}