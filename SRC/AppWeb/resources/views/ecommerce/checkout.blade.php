@extends('layouts.ecommerce')

@section('title')
    <title>Checkout - Ecommerce</title>
    <script src="https://kit.fontawesome.com/447d35bc3e.js" crossorigin="anonymous"></script>
    <style>
        .wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 10px;
        grid-auto-rows: minmax(100px, auto);
        justify-content: center;
        }
        .one {
        grid-column: 1 / 3;
        grid-row: 1;
        }
        .two {
        grid-column: 2 / 4;
        grid-row: 1 / 3;
        }
        .three {
        grid-column: 1;
        grid-row: 2 / 5;
        }
    </style>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Shipping Information</h2>
					<div class="page_link">
            <a href="{{ url('/') }}">Home</a>
						<a href="#">Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap">
		<div class="container">
			<div class="billing_details">
                <div class="wrapper">
                    <div class="one">
                        <div class="col-lg-6">
                            <h3>Shipping Information</h3>          
                            @if (session('error')=="Please Login")
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                <a href="{{ route('customer.login') }}" class="btn btn-dark btn-sm">Go to Login</a>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @isset($user_information)
                            <b>Full Name: </b> <label>{{$user_information->name}}</label>
                            <br>
                            <b>Email: </b> <label>{{$user_information->email}}</label>
                            <br>
                            <b>Phone number: </b><label>{{$user_information->phone_number}}</label>
                            <br>
                            <b>Province: </b> <label>{{$user_information->district->city->province->name}}</label>
                            <br>
                            <b>City: </b> <label>{{$user_information->district->city->name}}</label>
                            <br>
                            <b>District: </b> <label>{{$user_information->district->name}}</label>
                            <br>
                            <b>Address: </b> <label>{{$user_information->address}}</label>
                            <br>
                            @endisset
                        </div>
                    </div>
                    <div class="two">  
                    <form class="row contact_form" action="{{ route('pay_with_paypal') }}" method="post" novalidate="novalidate">
                        <div class="col-lg-12">
                            <div class="order_box">
                                @csrf

                                <h2>Order Summary</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Product
                                            <span>Total</span>
                                        </a>
                                    </li>
                                    @foreach ($carts as $cart)
                                        <li>
                                            <a href="#">{{ \Str::limit($cart['product_name'], 30) }}
                                            <span class="middle">x {{ $cart['qty'] }}</span>
                                            <span class="last">$ {{ number_format($cart['product_price']) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal
                                        <span>$ {{ $subtotal }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Delivery
                                            <span>$ 0</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Total
                                            <span>$ {{ $subtotal }}</span>
                                        </a>
                                    </li>
                                </ul>
                                <input id="paymanet_amount" name="payment_amount" type="hidden" value="{{$subtotal}}">
                                <button class="main_btn">Pay Order</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->
@endsection