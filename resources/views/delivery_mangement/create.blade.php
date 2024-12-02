@extends('front-layout')

@section('content')


<style>
    .error {
        color: red;
        font-size: 0.875rem;
    }
</style>

<div class="container px-5 mt-5">
    <h1 class="text-center mb-5">Delivery Request</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('deliverRequest.store') }}" method="POST" enctype="multipart/form-data" class="validator" id="delivery_request_form" name="delivery_request_form">
        @csrf

        <h4 class="mb-5">Delivery Information</h4>

        <div class="mb-3">
            <label for="pickup_address" class="form-label">Pickup Address: <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('pickup_address') is-invalid @enderror" id="pickup_address" name="pickup_address" required value="{{ old('pickup_address') }}">
            @error('pickup_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pickup_name" class="form-label">Pickup Name: <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('pickup_name') is-invalid @enderror" id="pickup_name" name="pickup_name" required value="{{ old('pickup_name') }}">
            @error('pickup_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pickup_contact_no" class="form-label">Pickup Contact No: <span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control @error('pickup_contact_no') is-invalid @enderror" id="pickup_contact_no" name="pickup_contact_no" required value="{{ old('pickup_contact_no') }}">
            @error('pickup_contact_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pickup_email" class="form-label">Pickup Email:</label>
            <input type="email" class="form-control @error('pickup_email') is-invalid @enderror" id="pickup_email" name="pickup_email" value="{{ old('pickup_email') }}">
            @error('pickup_email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address: <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('delivery_address') is-invalid @enderror" id="delivery_address" name="delivery_address" required value="{{ old('delivery_address') }}">
            @error('delivery_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_name" class="form-label">Delivery Name: <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('delivery_name') is-invalid @enderror" id="delivery_name" name="delivery_name" required value="{{ old('delivery_name') }}">
            @error('delivery_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_contact_no" class="form-label">Delivery Contact No: <span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control @error('delivery_contact_no') is-invalid @enderror" id="delivery_contact_no" name="delivery_contact_no" required value="{{ old('delivery_contact_no') }}">
            @error('delivery_contact_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_email" class="form-label">Delivery Email:</label>
            <input type="email" class="form-control @error('delivery_email') is-invalid @enderror" id="delivery_email" name="delivery_email" value="{{ old('delivery_email') }}">
            @error('delivery_email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for ="type_of_good" class="form-label">Type of Good: <span class="text-danger">*</span></label>
            <select class="form-select @error('type_of_good') is-invalid @enderror" id="type_of_good" name="type_of_good" required>      
                <option value="1" {{ old('type_of_good') == '1' ? 'selected' : '' }}>Document</option>
                <option value="2" {{ old('type_of_good') == '2' ? 'selected' : '' }}>Parcel</option>
            </select>
            @error('type_of_good')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_provider" class="form-label">Delivery Provider: <span class="text-danger">*</span></label>
            <select class="form-select @error('delivery_provider') is-invalid @enderror" id="delivery_provider" name="delivery_provider" required>          
                <option value="1" {{ old('delivery_provider') == '1' ? 'selected' : '' }}>DHL</option>
                <option value="2" {{ old('delivery_provider') == '2' ? 'selected' : '' }}>STARTRACK</option>
                <option value="3" {{ old('delivery_provider') == '3' ? 'selected' : '' }}>ZOOM2U</option>
                <option value="4" {{ old('delivery_provider') == '4' ? 'selected' : '' }}>TGE</option>
            </select>
            @error('delivery_provider')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority: <span class="text-danger">*</span></label>
            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>Standard</option>
                <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>Express</option>
                <option value="3" {{ old('priority') == '3' ? 'selected' : '' }}>Immediate</option>
            </select>
            @error('priority')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="shipment_pickup_date" class="form-label">Shipment Pickup Date: <span class="text-danger">*</span></label>
            <input type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control @error('shipment_pickup_date') is-invalid @enderror" id="shipment_pickup_date" name="shipment_pickup_date" required value="{{ old('shipment_pickup_date') }}">
            @error('shipment_pickup_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="shipment_pickup_time" class="form-label">Shipment Pickup Time: <span class="text-danger">*</span></label>
            <input type="time" class="form-control @error('shipment_pickup_time') is-invalid @enderror" id="shipment_pickup_time" name="shipment_pickup_time" required value="{{ old('shipment_pickup_time') }}">
            @error('shipment_pickup_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr class="mt-5">
        <h4 class="mb-5">Package Information</h4>

        <div class="mb-3">
            <label for="package_description" class="form-label">Package Description: <span class="text-danger">*</span></label>
            <textarea name="package_description" id="package_description" class="form-control @error('package_description') is-invalid @enderror" rows="5" required>{{ old('package_description') }}</textarea>
            @error('package_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="length" class="form-label">Length: (centimeters)<span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control @error('length') is-invalid @enderror" id="length" name="length" required value="{{ old('length') }}">
            @error('length')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Height: (centimeters)<span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control @error('height') is-invalid @enderror" id="height" name="height" required value="{{ old('height') }}">
            @error('height')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="width" class="form-label">Width: (centimeters)<span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control @error('width') is-invalid @enderror" id="width" name="width" required value="{{ old('width') }}">
            @error('width')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Weight: (gram)<span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" required value="{{ old('weight') }}">
            @error('weight')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a class="btn btn-secondary mt-4 mb-5" href="{{ route('deliverRequest.index') }}">Back </a> 
        <button type="submit" class="btn btn-success ms-4 mt-4 mb-5">Submit</button>
    </form>
</div>

@endsection