@extends('layouts.ecommerce')

@section('title')
    <title>My Orders - Ecommerce</title>
    <script src="https://kit.fontawesome.com/447d35bc3e.js" crossorigin="anonymous"></script>
    
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        .container {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px;
            background-color: #fff
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Dashboard</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('customer.orders') }}">My orders</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Feature Product Area =================-->
	<section class="feature_product_area section_gap">
		<div class="main_box">
			<div class="container-fluid">
				<div class="row">
					<div class="main_title">
						<h2>My Orders</h2>
					</div>
				</div>
				<div class="row">
                    @forelse($orders as $row)
                    <div class="container">
                        <article class="card">
                            <header class="card-header"> Order ID: {{$row->invoice}} </header>
                            <div class="card-body">
                                <article class="card">
                                    <div class="card-body row">
                                        <div class="col"> <strong>Estimated Delivery time:</strong> <br> {{date("F j, Y",strtotime(date("F j, Y", strtotime($row->created_at . "-12 hours"))."+ 1 days"))}} </div>
                                        <div class="col"> <strong>Shipping BY:</strong> <br> Olva Courier | <i class="fa fa-phone"></i> +01 714 0909 </div>
                                        <div class="col"> <strong>Status:</strong> <br> 
                                        @if ($row->status == "confirmed")
                                            Order confirmed
                                        @elseif ($row->status == "picked_by_courier")
                                            Picked by courier
                                        @elseif ($row->status ==  "on_the_way")
                                            On the way
                                        @elseif ($row->status == "ready_for_pick_up")
                                            Ready for pick up
                                        @else 
                                            Delivery received
                                        @endif </div>
                                        <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                                    </div>
                                </article>
                                <div class="track">
                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                                    <div 
                                        @if ($row->status == "picked_by_courier" || $row->status ==  "on_the_way" || $row->status == "ready_for_pick_up" ||  $row->status == "delivery_received" )
                                            class="step active"
                                        @else class= "step"
                                        @endif> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                                    <div @if ($row->status ==  "on_the_way" || $row->status == "ready_for_pick_up" ||  $row->status == "delivery_received")
                                            class="step active"
                                        @else class= "step"
                                        @endif> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                    <div @if ($row->status == "ready_for_pick_up" ||  $row->status == "delivery_received")
                                            class="step active"
                                        @else class= "step"
                                        @endif> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pick up</span> </div>
                                    <div @if ($row->status == "delivery_received")
                                            class="step active"
                                        @else class= "step"
                                        @endif> <span class="icon"> <i class="fa fa-star"></i> </span> <span class="text">Delivery received</span> </div>
                                </div>
                                <hr>
                                <ul class="row">
                                    @foreach ($row->product as $product)
                                    <li class="col-md-4">
                                        <figure class="itemside mb-3 border">
                                            <div class="aside"><img src="{{ asset('storage/products/' . $product->image) }}" class="img-sm"></div>
                                            <figcaption class="info align-self-center">
                                                <p class="title"> {{$product->name}} <span class="text-muted">${{$product->price}} </span> <br> x{{$product->pivot->qty}}</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    @endforeach
                                </ul>
                                @if($row->status == "ready_for_pick_up")
                                <form action="{{ route('customer.delivery_received', $row->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <button class="btn btn-warning" data-abc="true"> <i class="fa fa-star"></i> <i class="fa fa-check"></i> Delivery Received </button>
                                </form>
                                @endif
                            </div>
                        </article>
                    </div>
                    @empty
                                
                    @endforelse
				</div>
                {!! $orders->links() !!}
			</div>
		</div>
	</section>
	<!--================End Feature Product Area =================-->
@endsection