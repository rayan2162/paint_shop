@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Due Management</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for Adding New Due -->
    <form action="{{ route('due.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="phone_no" class="form-control" placeholder="Phone No" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="amount" class="form-control" placeholder="Amount" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="info" class="form-control" placeholder="Info">
            </div>
            <div class="col-md-2">
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Add Due</button>
            </div>
        </div>
    </form>

    <!-- Search Bar -->
    <form action="{{ route('due.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name" value="{{ $search }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>

    <!-- Due List Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone No</th>
                <th>Amount</th>
                <th>Info</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dues as $due)
                <tr>
                    <td>{{ $due->name }}</td>
                    <td>{{ $due->phone_no }}</td>
                    <td>{{ $due->amount }}</td>
                    <td>{{ $due->info }}</td>
                    <td>{{ $due->date }}</td>
                    <td>
                        <a href="{{ route('due.edit', $due->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('due.destroy', $due->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6">No due records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
