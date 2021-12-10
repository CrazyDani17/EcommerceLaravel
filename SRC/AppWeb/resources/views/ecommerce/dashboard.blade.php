@extends('layouts.ecommerce')

@section('title')
    <title>Dashboard - Ecommerce</title>
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
                        <a href="{{ route('customer.dashboard') }}">Dashboard</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container-fluid">
            <div class="row flex-row-reverse">
				<div class="col-lg-9">
					<div class="profile_top_bar">
						<h3 class="text-center">Your profile</h2>
					</div>
					<div class="s_product_text">
						<h5 class="text-center">User name: {{$customer_info->name}}</h5>
						<h5 class="text-center">Email: {{$customer_info->email}}</h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="left_sidebar_area">
						<aside class="left_widgets cat_widgets">
							<div class="l_w_title">
								<h3>Options</h3>
							</div>
							<div class="widgets_inner">
								<ul class="list">
									<li>
										<strong><a href="{{ route('customer.favorites') }}">Favorites</a></strong>
									</li>
									<li>
										<strong><a href="{{ route('customer.orders') }}">My orders</a></strong>
									</li>
									<li>
										<strong><a href="{{ route('customer.edit_form') }}">Edit your profile</a></strong>
									</li>
									<li>
										<strong><a href="{{ route('customer.restore_pass_form') }}">Restore password</a></strong>
									</li>
									<li>
									<form action="{{ route('customer.destroy_account') }}" method="post">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger btn-sm">Delete your account</button>
                                    </form>
									</li>
								</ul>
							</div>
						</aside>
					</div>
				</div>
			</div>	
		</div>
		
	</section>
	
@endsection