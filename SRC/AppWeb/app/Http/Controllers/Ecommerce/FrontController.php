<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\Customer;

class FrontController extends Controller
{
    public function index()
	{
	    $products = Product::orderBy('created_at', 'DESC')->paginate(10);
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.index', compact('products','n_carts','user_name'));
		}
	    return view('ecommerce.index', compact('products','n_carts'));
	}

	public function product()
	{
	    $products = Product::orderBy('created_at', 'DESC')->paginate(12);
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.product', compact('products','n_carts','user_name'));
		}
	    return view('ecommerce.product', compact('products','n_carts'));
	}

	 public function categoryProduct($slug)
	{
	    $products = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.product', compact('products','n_carts','user_name'));
		}
	    return view('ecommerce.product', compact('products','n_carts'));
	}

	public function show($slug)
	{
	    $product = Product::with(['category'])->where('slug', $slug)->first();
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_id = auth()->guard('customer')->user()->id;
			$user_name = auth()->guard('customer')->user()->name;
			return view('ecommerce.show', compact('product','n_carts','user_id','user_name'));
		}
	    return view('ecommerce.show', compact('product','n_carts'));
	}

	public function verifyCustomerRegistration($token)
	{
	    $customer = Customer::where('activate_token', $token)->first();
	    if ($customer) {
	        $customer->update([
	            'activate_token' => null,
	            'status' => 1
	        ]);
	        return redirect(route('customer.login'))->with(['success' => 'Verification Successful, Please Login']);
	    }
	    return redirect(route('customer.login'))->with(['error' => 'Invalid Verification Token']);
	}

	public function favorites()
	{
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_id = auth()->guard('customer')->user()->id;
			$user_name = auth()->guard('customer')->user()->name;
			$customer = Customer::findOrFail($user_id);
			$products= $customer->product()->get();
			$out = new \Symfony\Component\Console\Output\ConsoleOutput();
			$out->writeln($products);
			return view('ecommerce.favorites', compact('products','n_carts','user_name'));
		}
	}

	public function orders()
	{
		$n_carts = $this->getNCarts();
		if (auth()->guard('customer')->check()){
			$user_id = auth()->guard('customer')->user()->id;
			$user_name = auth()->guard('customer')->user()->name;
			$orders = Order::orderBy('created_at', 'DESC');
			$orders = $orders->where('customer_id', $user_id);
			$orders= $orders->paginate(7);
			return view('ecommerce.orders', compact('orders','n_carts','user_name'));
		}
	}

	public function delivery_received($id)
    {
        $order = Order::find($id);

	    $order->update([
			'status'=> 'delivery_received'
	    ]);

	    return redirect(route('customer.orders'))->with(['success' => 'Order Status Updated']);
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

	public function search(Request $request){
		$term = $request->get('term');
		$products = Product::where('name', 'LIKE', '%'.$term.'%')->get();
		$categories = Category::where('name', 'LIKE', '%'.$term.'%')->get();
		$data = [];
		foreach($products as $product){
			$data[] = [
				'label' => $product->name,
				'slug' => $product->slug
			];
		}
		foreach($categories as $category){
			$data[] = [
				'label' => $category->name,
				'category' => $category->slug
			];
		}
		return $data;
	}

	public function search_with_button(Request $request){
		$out = new \Symfony\Component\Console\Output\ConsoleOutput();
		$out->writeln($request->item);
		$term = $request->item;
		if($term == NULL){
			return redirect(route('front.product'));
		}
		$category = Category::where('name', 'LIKE', '%'.$term.'%')->first();
		if($category){
			return redirect(route('front.category',$category->slug));
		}
		$product = Product::where('name', 'LIKE', '%'.$term.'%')->first();
		
		if($product){
			return redirect(route('front.show_product',$product->slug));
		}
		
		return redirect(route('front.product'));
	}
}
