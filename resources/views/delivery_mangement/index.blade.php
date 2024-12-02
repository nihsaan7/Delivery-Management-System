@extends('front-layout')

@section('content')


<div class="container px-5 mt-5">
    <p class="float-right mb-2">
        <a class="btn btn-primary mb-5" href="{{ route('deliverRequest.create') }}">Create a Delivery Request</a> 
    </p>

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

    <div class="list-group">
        @if($delivery_request->count() != 0)
            @foreach($delivery_request as $data)
                <div class="list-group-item">
                    <h5 class="mb-1">{{ $data->pickup_address }}</h5>
                    <p class="mb-1">Pickup Name: {{ $data->pickup_name }}</p>
                    <p class="mb-1">Delivery Address: {{ $data->delivery_address }}</p>
                    <p class="mb-1">Delivery Email: {{ $data->delivery_email }}</p>
                    <p class="mb-1">Status: 
                        @if($data->status == 0)
                            Pending
                        @elseif($data->status == 1)
                            Cancelled
                        @elseif($data->status == 2)
                            Processed
                        @else
                            Shipped
                        @endif
                    </p>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Created at: {{ $data->created_at->format('Y-m-d H:i') }}</small>
                        <div>
                            <form action="{{ route('deliverRequest.statusChange') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="hiddenID" value="{{$data->id}}" />
                                @if($data->status == 0)
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Cancel</button>
                                @elseif($data->status == 2)
                                    <button class="btn btn-warning btn-sm" disabled>Processed</button>
                                @elseif($data->status == 3)
                                    <button class="btn btn-warning btn-sm" disabled>Shipped</button>
                                @else
                                    <button class="btn btn-danger btn-sm" disabled>Cancelled</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="list-group-item text-center">No Information</div>
        @endif
    </div>

    <div class="pagination justify-content-center mt-3 mb-5">
        {{ $delivery_request->links('pagination.bootstrap-4') }}
    </div>

</div>

@endsection