@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Order</h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="{{ $order->product_name }}" required>
        </div>

        <div class="mb-3">
            <label for="company">Company</label>
            <input type="text" id="company" name="company" class="form-control" value="{{ $order->company }}" required>
        </div>

        <div class="mb-3">
            <label for="details">Details</label>
            <input type="text" id="details" name="details" class="form-control" value="{{ $order->details }}">
        </div>

        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $order->quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
