<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
    
    @yield('title')
    
	<link rel="stylesheet" href="{{ asset('ecommerce/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/linericon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/lightbox/simpleLightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/nice-select/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/animate-css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/jquery-ui/jquery-ui.css') }}">
	
	<link rel="stylesheet" href="{{ asset('ecommerce/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/css/responsive.css') }}">
</head>

<body>
	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="top_menu row m0">
			<div class="container-fluid">
				<div class="float-right">
					<ul class="right_side">
						@if (auth()->guard('customer')->check())
						    <li><a href="{{ route('customer.logout') }}">Logout</a></li>
						@else
						    <li><a href="{{ route('customer.login') }}">Login</a></li>
							<li><a href="{{ route('customer.register') }}">Register</a></li>
						@endif
						<li><a href="{{ route('customer.dashboard') }}">My Account</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container-fluid">
                    <a class="navbar-brand logo_h" href="{{ url('/') }}">
						<img src="https://media.discordapp.net/attachments/880608338348482631/918651882094878730/header_logo.png?width=1440&height=509" width="140" height="50" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					 aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<div class="row w-100">
							<div class="col-lg-8 pr-0">
								@include('layouts.ecommerce.module.menu')
							</div>

							<div class="col-lg-4">
								<ul class="nav navbar-nav navbar-right right_nav pull-right">
									@isset($user_name)
									<li class="nav-item">
										<a href="{{ route('customer.dashboard') }}" class="icons">
											<i class="fa fa-user" aria-hidden="true"></i> {{$user_name}}
										</a>
									</li>
									@else
									<li class="nav-item">
										<a href="#" class="icons">
											<i class="fa fa-user" aria-hidden="true"></i>
										</a>
									</li>
									@endisset
									<hr>
									<li class="nav-item">
										<a href="{{ route('customer.favorites') }}" class="icons">
											<i class="fa fa-heart-o" aria-hidden="true"></i>
										</a>
									</li>
									<hr>
									<li class="nav-item">
										<a href="{{ route('front.list_cart') }}" class="icons">
											<i class="lnr lnr lnr-cart"></i> {{$n_carts}}
										</a>
									</li>
									<hr>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->

    @yield('content')

	<!--================ start footer Area  =================-->
	<footer class="footer-area section_gap">
		<div class="container">	
			<div class="row footer-bottom d-flex justify-content-between align-items-center">
				<p class="col-lg-12 footer-text text-center">
					&copy; 2021 Project made by Daniel Mendiguri
				</p>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->

	<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/popper.js') }}"></script>
	<script src="{{ asset('ecommerce/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/stellar.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/lightbox/simpleLightbox.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/isotope/isotope-min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/flipclock/timer.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/counter-up/jquery.counterup.js') }}"></script>
	<script src="{{ asset('ecommerce/js/mail-script.js') }}"></script>
	<script src="{{ asset('ecommerce/js/theme.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/jquery-ui/jquery-ui.js') }}"></script>
	@yield('js')
	<script>
		//var products = ['queso','tacos','xddddd'];
		$('#search').autocomplete({
			source: function(request, response){
				$.ajax({
					url:"{{route('front.search')}}",
					dataType: 'json',
					data: {
						term: request.term
					},
					success: function(data){
						response(data)
					}
				});
			},
			select: function(event, ui) {
				//location.href="product/" + ui.item.slug;
				if(ui.item.slug){
					location.href="{{route('front.product')}}" + "/" + ui.item.slug;
				}
				else if(ui.item.category){
					location.href="{{route('front.index')}}" + "/category/" + ui.item.category;
				}
				else{
					location.href="{{route('front.product')}}";
				}
			}
		});
	</script>
</body>
</html>