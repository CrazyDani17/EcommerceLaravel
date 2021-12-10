@extends('layouts.admin')

@section('title')
    <title>Edit Customer</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Customer</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('customer.update', $customer->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Customer</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control" value="{{ $customer->name }}" required>
                                    <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $customer->status == '1' ? 'selected':'' }}>Verified</option>
                                        <option value="0" {{ $customer->status == '0' ? 'selected':'' }}>Non-verified</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $customer->phone_number }}" required>
                                    <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="customer_address" class="form-control" value="{{ $customer->address }}" required>
                                    <p class="text-danger">{{ $errors->first('custommer_address') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Province</label>
                                    <select class="form-control" name="province_id" id="province_id" required>
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $row)
                                        <option value="{{ $row->id }}" 
                                        @if ($row->id == old('province_id', $customer->district->city->province->id))
                                            selected="selected"
                                        @endif>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('province_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">County / City</label>
                                    <select class="form-control" name="city_id" id="city_id" required>
                                        <option value="">Select County / City</option>
                                        @foreach ($cities as $row)
                                        <option value="{{ $row->id }}" 
                                        @if ($row->id == old('city_id', $customer->district->city->id))
                                            selected="selected"
                                        @endif>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('city_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">District</label>
                                    <select class="form-control" name="district_id" id="district_id" required>
                                        <option value="">Select District</option>
                                        @foreach ($districts as $row)
                                        <option value="{{ $row->id }}" 
                                        @if ($row->id == old('district_id', $customer->district->id))
                                            selected="selected"
                                        @endif>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('district_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
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