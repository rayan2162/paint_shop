@extends('layouts.app')

@section('content')

<div class="container my-4">
    <div  class="text-center">
        <h2>Paint Shop Name</h2>
        <h4>Address</h4>
        <h6>Phone number: 01641309424</h6>
    </div>
    <br><br>

    <!-- Invoice Details -->
    <div class="mb-3 row">
        <div class="col-md-6 d-flex align-items-center">
            <label class="col-form-label mr-3">Serial:</label>
            <input type="text" id="serial_no" class="form-control" placeholder="Enter Serial Number">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <label class="col-form-label mr-3">Date:</label>
            <input type="date" id="date" class="form-control">
        </div>
    </div>

    <div class="d-flex align-items-center">
        <label class="col-form-label mr-3">Name:</label>
        <input type="text" id="name" class="form-control" placeholder="Customer Name">
    </div>
    
    <br>

    <div class="mb-3 row">
        <div class="col-md-6 d-flex align-items-center">
            <label class="col-form-label mr-3">Phone:</label>
            <input type="text" id="phone" class="form-control" placeholder="Customer Phone Number">
        </div>
        
        <div class="col-md-6 d-flex align-items-center">
            <label class="col-form-label mr-3">Address:</label>
            <input type="text" id="address" class="form-control" placeholder="Customer Address">
        </div>
    </div>

    <!-- Item Table -->
    <table class="table table-bordered" id="items_table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody id="item_rows">
            <tr>
                <td><input type="text" class="form-control" placeholder="Item Name"></td>
                <td><input type="number" class="form-control" placeholder="Rate" oninput="calculatePrice(this)"></td>
                <td><input type="number" class="form-control" placeholder="Quantity" oninput="calculatePrice(this)"></td>
                <td><input type="number" class="form-control" placeholder="Price" readonly></td>
            </tr>
        </tbody>
    </table>

    <!-- Summary Row -->
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Total:</span>
                </div>
                <input type="number" id="total" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Paid:</span>
                </div>
                <input type="number" id="paid" class="form-control" oninput="calculateDue()">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Due:</span>
                </div>
                <input type="number" id="due" class="form-control" readonly>
            </div>
        </div>
    </div>
    
    <br><br>

    <div class="text-center">
        <!-- Print Button -->
        <button type="button" class="btn btn-primary" onclick="addRow()">Add Item</button>
        <button type="button" class="btn btn-success" onclick="window.print()">Print Invoice</button>
    </div>


</div>

<script>
// Add row to item table
function addRow() {
    const row = `<tr>
        <td><input type="text" class="form-control" placeholder="Item Name"></td>
        <td><input type="number" class="form-control" placeholder="Rate" oninput="calculatePrice(this)"></td>
        <td><input type="number" class="form-control" placeholder="Quantity" oninput="calculatePrice(this)"></td>
        <td><input type="number" class="form-control" placeholder="Price" readonly></td>
    </tr>`;
    document.getElementById('item_rows').insertAdjacentHTML('beforeend', row);
}


// Calculate price for each item
function calculatePrice(input) {
    const row = input.closest('tr');
    const rate = parseFloat(row.querySelector('input[placeholder="Rate"]').value) || 0;
    const quantity = parseFloat(row.querySelector('input[placeholder="Quantity"]').value) || 0;
    const priceField = row.querySelector('input[placeholder="Price"]');
    priceField.value = rate * quantity;
    calculateTotal();
}

// Calculate total, paid, and due amounts
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('input[placeholder="Price"]').forEach(priceField => {
        total += parseFloat(priceField.value) || 0;
    });
    document.getElementById('total').value = total;
    calculateDue();
}

function calculateDue() {
    const total = parseFloat(document.getElementById('total').value) || 0;
    const paid = parseFloat(document.getElementById('paid').value) || 0;
    document.getElementById('due').value = total - paid;
}
</script>

@endsection
