@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Orders</h2>

    <!-- Form to Add a New Order -->
    <form action="{{ route('orders.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="company" class="form-control" placeholder="Company" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="details" class="form-control" placeholder="Details">
            </div>
            <div class="col-md-1">
                <input type="number" name="quantity" class="form-control" placeholder="Qty" required>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="shipped">Shipped</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Order</button>
    </form>

    <!-- Search Form -->
    <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Search by Product Name" value="{{ request('search') }}">
    </form>

    <!-- Orders Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Company</th>
                <th>Details</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->product_name }}</td>
                    <td>{{ $order->company }}</td>
                    <td>{{ $order->details }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
