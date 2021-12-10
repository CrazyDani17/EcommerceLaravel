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
      
        //JIKA TERDAPAT PARAMETER PENCARIAN DI URL ATAU Q PADA URL TIDAK SAMA DENGAN KOSONG
        if (request()->q != '') {
            //MAKA LAKUKAN FILTERING DATA BERDASARKAN NAME DAN VALUENYA SESUAI DENGAN PENCARIAN YANG DILAKUKAN USER
            $delivery_guys = $delivery_guys->where('name', 'LIKE', '%' . request()->q . '%');
        }

		if (auth()->guard('courier')->check()){
			$courier_id = auth()->guard('courier')->user()->id;
		}
        //TERAKHIR LOAD 10 DATA PER HALAMANNYA

		$delivery_guys = $delivery_guys->where('courier_id',$courier_id);

        $delivery_guys= $delivery_guys->paginate(10);
        //LOAD VIEW INDEX.BLADE.PHP YANG BERADA DIDALAM FOLDER PRODUCTS
        //DAN PASSING VARIABLE $PRODUCT KE VIEW AGAR DAPAT DIGUNAKAN
        return view('courier.delivery_guys.index', compact('delivery_guys'));
    }

	/*public function store(Request $request)
	{
	    //VALIDASI REQUESTNYA
	    $this->validate($request, [
	        'name' => 'required|string|max:100',
	        'description' => 'required',
	        'category_id' => 'required|exists:categories,id', //CATEGORY_ID KITA CEK HARUS ADA DI TABLE CATEGORIES DENGAN FIELD ID
	        'price' => 'required|integer',
	        'weight' => 'required|integer',
	        'image' => 'required|image|mimes:png,jpeg,jpg' //GAMBAR DIVALIDASI HARUS BERTIPE PNG,JPG DAN JPEG
	    ]);

	    //JIKA FILENYA ADA
	    if ($request->hasFile('image')) {
	        //MAKA KITA SIMPAN SEMENTARA FILE TERSEBUT KEDALAM VARIABLE FILE
	        $file = $request->file('image');
	        //KEMUDIAN NAMA FILENYA KITA BUAT CUSTOMER DENGAN PERPADUAN TIME DAN SLUG DARI NAMA PRODUK. ADAPUN EXTENSIONNYA KITA GUNAKAN BAWAAN FILE TERSEBUT
	        $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
	        //SIMPAN FILENYA KEDALAM FOLDER PUBLIC/PRODUCTS, DAN PARAMETER KEDUA ADALAH NAMA CUSTOM UNTUK FILE TERSEBUT
	        $file->storeAs('public/products', $filename);

	        //SETELAH FILE TERSEBUT DISIMPAN, KITA SIMPAN INFORMASI PRODUKNYA KEDALAM DATABASE
	        $product = Product::create([
	            'name' => $request->name,
	            'slug' => $request->name,
	            'category_id' => $request->category_id,
	            'description' => $request->description,
	            'image' => $filename, //PASTIKAN MENGGUNAKAN VARIABLE FILENAM YANG HANYA BERISI NAMA FILE SAJA (STRING)
	            'price' => $request->price,
	            'weight' => $request->weight,
	            'status' => $request->status
	        ]);
	        //JIKA SUDAH MAKA REDIRECT KE LIST PRODUK
	        return redirect(route('product.index'))->with(['success' => 'New Product Added']);
	    }
	}*/


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
			'activate_token' => Str::random(30), //TAMBAKAN LINE INI
			'status' => true,
			'courier_id' => $courier_id
		]);

		//Mail::to($request->email)->send(new CustomerRegisterMail($customer, $request->password));

		return redirect()->intended(route('delivery_guy.index'));
	}

	public function edit($id)
	{
	    $delivery_guy = Delivery_guy::find($id); //AMBIL DATA PRODUK TERKAIT BERDASARKAN ID
	    return view('courier.delivery_guys.edit', compact('delivery_guy')); //LOAD VIEW DAN PASSING DATANYA KE VIEW
	}

	public function update(Request $request, $id)
	{
	   //VALIDASI DATANYA
	   $this->validate($request, [
			'name' => 'required|string|max:100',
			'email' => 'required|email',
			'phone_number' => 'required',
			'status' => 'required',
		]);

	    $delivery_guy = Delivery_guy::find($id); //AMBIL DATA PRODUK YANG AKAN DIEDIT BERDASARKAN ID

	  //KEMUDIAN UPDATE PRODUK TERSEBUT
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
	    $delivery_guy= Delivery_guy::find($id); //QUERY UNTUK MENGAMBIL DATA PRODUK BERDASARKAN ID
	    //HAPUS FILE IMAGE DARI STORAGE PATH DIIKUTI DENGNA NAMA IMAGE YANG DIAMBIL DARI DATABASE
	    //KEMUDIAN HAPUS DATA PRODUK DARI DATABASE
	    $delivery_guy->delete();
	    //DAN REDIRECT KE HALAMAN LIST PRODUK
	    return redirect(route('delivery_guy.index'))->with(['success' => 'Delivery guy Has Been Removed']);
	}


	/*public function massUploadForm()
	{
	    $category = Category::orderBy('name', 'DESC')->get();
	    return view('products.bulk', compact('category'));
	}

	public function massUpload(Request $request)
	{
	  //VALIDASI DATA YANG DIKIRIM
	    $this->validate($request, [
	        'category_id' => 'required|exists:categories,id',
	        'file' => 'required|mimes:xlsx' //PASTIKAN FORMAT FILE YANG DITERIMA ADALAH XLSX
	    ]);

	  	//JIKA FILE-NYA ADA
	    if ($request->hasFile('file')) {
	        $file = $request->file('file');
	        $filename = time() . '-product.' . $file->getClientOriginalExtension();
	        $file->storeAs('public/uploads', $filename); //MAKA SIMPAN FILE TERSEBUT DI STORAGE/APP/PUBLIC/UPLOADS

	        //BUAT JADWAL UNTUK PROSES FILE TERSEBUT DENGAN MENGGUNAKAN JOB
	        //ADAPUN PADA DISPATCH KITA MENGIRIMKAN DUA PARAMETER SEBAGAI INFORMASI
	        //YAKNI KATEGORI ID DAN NAMA FILENYA YANG SUDAH DISIMPAN
	        ProductJob::dispatch($request->category_id, $filename);
	        return redirect()->back()->with(['success' => 'Upload Produk Dijadwalkan']);
	    }
	}

	public function trending()
    {
        //BUAT QUERY MENGGUNAKAN MODEL PRODUCT, DENGAN MENGURUTKAN DATA BERDASARKAN CREATED_AT
        //KEMUDIAN LOAD TABLE YANG BERELASI MENGGUNAKAN EAGER LOADING WITH()
        //ADAPUN CATEGORY ADALAH NAMA FUNGSI YANG NNTINYA AKAN DITAMBAHKAN PADA PRODUCT MODEL
        $product = Product::with(['category']);
		$product = Product::selectRaw('products.*, sum(order_details.qty) as sales')->join('order_details','products.id','=','order_details.product_id')->groupBy('products.id','products.name','products.slug','products.description','products.category_id','products.image','products.price','products.weight','products.status','products.created_at','products.updated_at')->orderBy('sales','desc')->get();
        //TERAKHIR LOAD 10 DATA PER HALAMANNYA
        //$product = $product->paginate(10);
        //LOAD VIEW INDEX.BLADE.PHP YANG BERADA DIDALAM FOLDER PRODUCTS
        //DAN PASSING VARIABLE $PRODUCT KE VIEW AGAR DAPAT DIGUNAKAN
        return view('products.trending', compact('product'));
    }

	public function addFavorite(Request $request)
    {
		$customer = Customer::findOrFail(intval($request->user_id));
        $customer->product()->attach(intval($request->item_id));

		//$out = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$out->writeln( gettype(intval($request->user_id)) . " " .  gettype( intval($request->item_id)) );
	}

	public function deleteFavorite(Request $request)
    {
		$customer = Customer::findOrFail(intval($request->user_id));
        $customer->product()->detach(intval($request->item_id));
		//$out = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$out->writeln($request->user_id . " " . $request->item_id );
	}*/

}