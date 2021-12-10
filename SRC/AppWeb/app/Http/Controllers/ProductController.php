<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use App\Product;
use App\Category;
use App\Customer;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with(['category'])->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $product = $product->paginate(10);
        return view('products.index', compact('product'));
    }

    public function create()
	{
	    $category = Category::orderBy('name', 'DESC')->get();
	    return view('products.create', compact('category'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	        'name' => 'required|string|max:100',
	        'description' => 'required',
	        'category_id' => 'required|exists:categories,id',
	        'price' => 'required|integer',
	        'weight' => 'required|integer',
	        'image' => 'required|image|mimes:png,jpeg,jpg'
	    ]);

	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/products', $filename);
	        $product = Product::create([
	            'name' => $request->name,
	            'slug' => $request->name,
	            'category_id' => $request->category_id,
	            'description' => $request->description,
	            'image' => $filename,
	            'price' => $request->price,
	            'weight' => $request->weight,
	            'status' => $request->status
	        ]);
	        return redirect(route('product.index'))->with(['success' => 'New Product Added']);
	    }
	}

	public function edit($id)
	{
	    $product = Product::find($id);
	    $category = Category::orderBy('name', 'DESC')->get();
	    return view('products.edit', compact('product', 'category'));
	}

	public function update(Request $request, $id)
	{
	    $this->validate($request, [
	        'name' => 'required|string|max:100',
	        'description' => 'required',
	        'category_id' => 'required|exists:categories,id',
	        'price' => 'required|integer',
	        'weight' => 'required|integer',
	        'image' => 'nullable|image|mimes:png,jpeg,jpg'
	    ]);

	    $product = Product::find($id);
	    $filename = $product->image;
	  
	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/products', $filename);
	        File::delete(storage_path('app/public/products/' . $product->image));
	    }
	    $product->update([
	        'name' => $request->name,
	        'description' => $request->description,
	        'category_id' => $request->category_id,
	        'price' => $request->price,
	        'weight' => $request->weight,
	        'status' => $request->status,
	        'image' => $filename
	    ]);
	    return redirect(route('product.index'))->with(['success' => 'Product Data Updated']);
	}

	public function destroy($id)
	{
	    $product = Product::find($id);
	    File::delete(storage_path('app/public/products/' . $product->image));
	    $product->delete();
	    return redirect(route('product.index'))->with(['success' => 'Product Has Been Removed']);
	}

	public function trending()
    {
        $product = Product::with(['category']);
		$product = Product::selectRaw('products.*, sum(order_details.qty) as sales')->join('order_details','products.id','=','order_details.product_id')->groupBy('products.id','products.name','products.slug','products.description','products.category_id','products.image','products.price','products.weight','products.status','products.created_at','products.updated_at')->orderBy('sales','desc')->get();
        return view('products.trending', compact('product'));
    }

	public function addFavorite(Request $request)
    {
		$customer = Customer::findOrFail(intval($request->user_id));
        $customer->product()->attach(intval($request->item_id));
	}

	public function deleteFavorite(Request $request)
    {
		$customer = Customer::findOrFail(intval($request->user_id));
        $customer->product()->detach(intval($request->item_id));
	}

}
