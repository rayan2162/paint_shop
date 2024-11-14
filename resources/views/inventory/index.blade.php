@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inventory Management</h2>

    <!-- Flash Message for Success -->
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

    <!-- Form to Add New Product -->
    <form action="{{ route('inventory.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="buy_price" class="form-control" placeholder="Buy Price" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="sell_price" class="form-control" placeholder="Sell Price" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="stock_info" class="form-control" placeholder="Stock Info">
            </div>
            <div class="col-md-12">
                <textarea name="description" class="form-control" placeholder="Description"></textarea>
            </div>
            <div class="col-md-2 mt-3">
                <button type="submit" class="btn btn-success">Add Product</button>
            </div>
        </div>
    </form>

    <!-- Search Form -->
    <form method="GET" action="{{ route('inventory.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Search by Product Name" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Display Product List -->
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Company</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>Stock Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->buy_price }}</td>
                    <td>{{ $product->sell_price }}</td>
                    <td>{{ $product->stock_info }}</td>
                    <td>
                        <!-- Edit Link -->
                        <a href="{{ route('inventory.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('inventory.destroy', $product->id) }}" method="POST" style="display: inline;">
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
