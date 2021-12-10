<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use App\Courier;
use App\Mail\CustomerRegisterMail;
use DB;
use File;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $couriers = $couriers->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $couriers= $couriers->paginate(10);
        return view('couriers.index', compact('couriers'));
    }


    public function create()
    {
		return view('couriers.create');
    }

	public function store(Request $request)
	{

	    $this->validate($request, [
	        'name' => 'required|string|max:100',
			'email' => 'required|email',
			'phone_number' => 'required',
	    ]);

		$courier = Courier::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => "password",
			'phone_number' => $request->phone_number,
			'activate_token' => Str::random(30),
			'status' => true,
		]);

		return redirect()->intended(route('courier.index'));
	}

	public function edit($id)
	{
	    $courier = Courier::find($id);
	    return view('couriers.edit', compact('courier'));
	}

	public function update(Request $request, $id)
	{
	   $this->validate($request, [
			'name' => 'required|string|max:100',
			'email' => 'required|email',
			'phone_number' => 'required',
			'status' => 'required',
		]);

	    $courier = Courier::find($id);
	    $courier->update([
	        'name' => $request->name,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'status'=> $request->status,
	    ]);
	    return redirect(route('courier.index'))->with(['success' => 'Delivery guy Data Updated']);
	}

	public function destroy($id)
	{
	    $courier= Courier::find($id);
	    $courier->delete();
	    return redirect(route('courier.index'))->with(['success' => 'Delivery guy Has Been Removed']);
	}

}