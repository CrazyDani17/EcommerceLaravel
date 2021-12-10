@extends('layouts.ecommerce')

@section('title')
    <title>Restore password - Ecommerce</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Login</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('customer.restore_pass_form') }}">Restore password</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Login Box Area =================-->
	<section class="login_box_area p_120">
		<div class="container">
			<div class="row">
				<div class="offset-md-3 col-lg-6">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

					<div class="login_form_inner">
						<h3>Restore your password</h3>
						<form class="row login_form" action="{{ route('customer.post_retore_password') }}" method="post" id="contactForm" novalidate="novalidate">
						@csrf
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current password">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="btn submit_btn">Restore</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection