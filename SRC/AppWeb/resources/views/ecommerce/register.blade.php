@extends('layouts.ecommerce')

@section('title')
    <title>Register - Ecommerce</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Registration</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('customer.login') }}">Register</a>
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
						<h3>Enter the information to <br>create a new account</h3>
						<form class="row login_form" action="{{ route('customer.post_register') }}" method="post" id="contactForm" novalidate="novalidate">
						@csrf
                            <div class="col-md-12 form-group">
                                <label for="">Full name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                <p class="text-danger">{{ $errors->first('customer_name') }}</p>
							</div>
                            <div class="col-md-12 form-group">
                                <label for="">Phone number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                <p class="text-danger">{{ $errors->first('phone_number') }}</p>
							</div>
							<div class="col-md-12 form-group">
                                <label for="">Email</label>
								<input type="email" class="form-control" id="email" name="email" required>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
							</div>
							<div class="col-md-12 form-group">
                                <label for="">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
                                <p class="text-danger">{{ $errors->first('password') }}</p>
							</div>
                            <div class="col-md-12 form-group">
                            <label for="">Complete address</label>
                            <input type="text" class="form-control" id="add1" name="customer_address" required>
                            <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Province</label>
                                <select class="form-control" name="province_id" id="province_id" required>
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('province_id') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">County / City</label>
                                <select class="form-control" name="city_id" id="city_id" required>
                                    <option value="">Select County / City</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('city_id') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">District</label>
                                <select class="form-control" name="district_id" id="district_id" required>
                                    <option value="">Select District</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('district_id') }}</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn submit_btn">Register</button>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('js')
    <script>
        $('#province_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){
                    $('#city_id').empty()
                    $('#city_id').append('<option value="">Select County/City</option>')
                    $.each(html.data, function(key, item) {
                        $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })
        
        $('#city_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: { city_id: $(this).val() },
                success: function(html){
                    $('#district_id').empty()
                    $('#district_id').append('<option value="">Select District</option>')
                    $.each(html.data, function(key, item) {
                        $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })
    </script>
@endsection