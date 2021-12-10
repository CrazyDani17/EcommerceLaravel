<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use App\Mail\OrderMail;
use Illuminate\Support\Str;
use App\Product;
use App\Province;
use App\Order;
use App\OrderDetail;
use DB;
use Mail;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    public function payWithPayPal(Request $request)
    {
        if (auth()->guard('customer')->check()){
            $customer = auth()->guard('customer')->user();
        }
        else{
            return redirect()->back()->with(['error' => "Please Login"]);
        }
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($request->payment_amount);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            //$status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            $status = 'failed';
            //return redirect(route('front.store_checkout',$status));
            return $this->processCheckout($status);
            //return redirect('/paypal/failed')->with(compact('status'));
            
        }
        else{
            $payment = Payment::get($paymentId, $this->apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            // Execute the payment 
            $result = $payment->execute($execution, $this->apiContext);

            if ($result->getState() === 'approved') {
                //$status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
                $status = 'success';
                //return redirect(route('front.store_checkout',$status));
                return $this->processCheckout($status);
            }
            else{
                //$status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
                $status = 'failed';
                //return redirect(route('front.store_checkout',$status));
                return $this->processCheckout($status);
            }
            //->with(compact('status'));
        }
    }


    private function processCheckout($status)
	{
		if($status=="failed"){
			return redirect(route('front.checkout'))->with(['error' => "Sorry! Payment through PayPal could not be made."]);
		}
	    DB::beginTransaction();
	    try {
			if (auth()->guard('customer')->check()){
				$customer = auth()->guard('customer')->user();
			}
	        else{
	            return redirect(route('front.checkout'))->with(['error' => "Please Login"]);
	        }

	        $carts = $this->getCarts();
			$subtotal = 0;
			foreach ($carts as $cart){
				$subtotal += $cart['qty'] * $cart['product_price'];
			}
	        $order = Order::create([
	            'invoice' => Str::random(4) . '-' . time(),
	            'customer_id' => $customer->id,
	            'customer_name' => $customer->name,
	            'customer_phone' => $customer->phone_number,
	            'customer_address' => $customer->address,
	            'district_id' => $customer->district_id,
	            'subtotal' => $subtotal
	        ]);

	        foreach ($carts as $row) {
	            $product = Product::find($row['product_id']);
	            OrderDetail::create([
	                'order_id' => $order->id,
	                'product_id' => $row['product_id'],
	                'price' => $row['product_price'],
	                'qty' => $row['qty'],
	                'weight' => $product->weight
	            ]);
	        }
	        
	        DB::commit();

	        Mail::to($customer->email)->send(new OrderMail($customer, $order, $carts));
			$carts = [];
	        $cookie_cart = cookie('dw-carts', json_encode($carts), 2880);
	        return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie_cart);
	    } catch (\Exception $e) {
	        DB::rollback();
	        return redirect()->back()->with(['error' => $e->getMessage()]);
	    }
	}

    private function getCarts()
	{
	    $carts = json_decode(request()->cookie('dw-carts'), true);
	    $carts = $carts != '' ? $carts:[];
	    return $carts;
	}
}
