@extends('layouts.ecommerce')

@section('title')
    <title>Edit Profile - Ecommerce</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Edit Profile</h2>
					<div class="page_link">
            <a href="{{ url('/') }}">Home</a>
						<a href="#">Edit Profile</a>
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
				<div class="row">
					<div class="col-lg-8">
            <h3>Edit your profile</h3>          
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              <form class="row contact_form" action="{{ route('customer.post_edit') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-md-6 form-group p_star">
                            <label for="">Full name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $customer_info->name }}" required>
                            <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="">Phone number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $customer_info->phone_number }}" required>
                            <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label for="">Complete address</label>
                            <input type="text" class="form-control" id="add1" name="customer_address" value="{{ $customer_info->address }}" required>
                            <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label for="">Province</label>
                            <select class="form-control" name="province_id" id="province_id" required>
                                <option value="">Select Province</option>
                                @foreach ($provinces as $row)
                                <option value="{{ $row->id }}" 
                                @if ($row->id == old('province_id', $customer_info->district->city->province->id))
                                    selected="selected"
                                @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('province_id') }}</p>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label for="">County / City</label>
                            <select class="form-control" name="city_id" id="city_id" required>
                                <option value="">Select County / City</option>
                                @foreach ($cities as $row)
                                <option value="{{ $row->id }}" 
                                @if ($row->id == old('city_id', $customer_info->district->city->id))
                                    selected="selected"
                                @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('city_id') }}</p>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <label for="">District</label>
                            <select class="form-control" name="district_id" id="district_id" required>
                                <option value="">Select District</option>
                                @foreach ($districts as $row)
                                <option value="{{ $row->id }}" 
                                @if ($row->id == old('district_id', $customer_info->district->id))
                                    selected="selected"
                                @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('district_id') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn submit_btn">Edit</button>
                        </div>
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->
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
                    $('#district_id').empty()
                    $('#city_id').append('<option value="">Select County/City</option>')
                    $('#district_id').append('<option value="">Select District</option>')
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