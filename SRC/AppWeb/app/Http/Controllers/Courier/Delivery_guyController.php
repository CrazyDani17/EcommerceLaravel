<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use App\Delivery_guy;
use App\Mail\CustomerRegisterMail;
use DB;
use File;
use App\Jobs\ProductJob;

class Delivery_guyController extends Controller
{
    public function index()
    {
        $delivery_guys = Delivery_guy::orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $delivery_guys = $delivery_guys->where('name', 'LIKE', '%' . request()->q . '%');
        }

		if (auth()->guard('courier')->check()){
			$courier_id = auth()->guard('courier')->user()->id;
		}

		$delivery_guys = $delivery_guys->where('courier_id',$courier_id);

        $delivery_guys= $delivery_guys->paginate(10);
        return view('courier.delivery_guys.index', compact('delivery_guys'));
    }

    public function create()
    {
		return view('courier.delivery_guys.create');
    }

	public function store(Request $request)
	{

		if (auth()->guard('courier')->check()){
			$courier_id = auth()->guard('courier')->user()->id;
		}

	    $this->validate($request, [
	        'name' => 'required|string|max:100',
			'email' => 'required|email',
			'phone_number' => 'required',
	    ]);

		$delivery_guy = Delivery_guy::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => "password",
			'phone_number' => $request->phone_number,
			'activate_token' => Str::random(30),
			'status' => true,
			'courier_id' => $courier_id
		]);

		//Mail::to($request->email)->send(new CustomerRegisterMail($customer, $request->password));

		return redirect()->intended(route('delivery_guy.index'));
	}

	public function edit($id)
	{
	    $delivery_guy = Delivery_guy::find($id);
	    return view('courier.delivery_guys.edit', compact('delivery_guy'));
	}

	public function update(Request $request, $id)
	{
	   $this->validate($request, [
			'name' => 'required|string|max:100',
			'email' => 'required|email',
			'phone_number' => 'required',
			'status' => 'required',
		]);

	    $delivery_guy = Delivery_guy::find($id);

	    $delivery_guy->update([
	        'name' => $request->name,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'status'=> $request->status,
	    ]);
	    return redirect(route('delivery_guy.index'))->with(['success' => 'Delivery guy Data Updated']);
	}

	public function destroy($id)
	{
	    $delivery_guy= Delivery_guy::find($id);
	    $delivery_guy->delete();
	    return redirect(route('delivery_guy.index'))->with(['success' => 'Delivery guy Has Been Removed']);
	}

}
