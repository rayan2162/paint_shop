<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Product</h2>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Product Form -->
    <form action="{{ route('inventory.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name', $product->company_name) }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <div class="form-group">
            <label for="buy_price">Buy Price</label>
            <input type="number" id="buy_price" name="buy_price" class="form-control" step="0.01" value="{{ old('buy_price', $product->buy_price) }}" required>
        </div>

        <div class="form-group">
            <label for="sell_price">Sell Price</label>
            <input type="number" id="sell_price" name="sell_price" class="form-control" step="0.01" value="{{ old('sell_price', $product->sell_price) }}" required>
        </div>

        <div class="form-group">
            <label for="stock_info">Stock Info</label>
            <input type="text" id="stock_info" name="stock_info" class="form-control" value="{{ old('stock_info', $product->stock_info) }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
