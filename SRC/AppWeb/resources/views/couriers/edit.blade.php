@extends('layouts.admin')

@section('title')
    <title>Edit Courier</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Courier</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ route('courier.update', $courier->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Delivery Guy</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Delivery Guy Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $courier->name }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $courier->email }}" required>
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
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
                                        <option value="1" {{ $courier->status == '1' ? 'selected':'' }}>Verified</option>
                                        <option value="0" {{ $courier->status == '0' ? 'selected':'' }}>Non-verified</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $courier->phone_number }}" required>
                                    <p class="text-danger">{{ $errors->first('phone_number') }}</p>
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