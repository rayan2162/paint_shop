@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Due Record</h2>

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

    <!-- Edit Due Form -->
    <form action="{{ route('due.update', $due->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $due->name) }}" required>
        </div>

        <div class="form-group">
            <label for="phone_no">Phone No</label>
            <input type="text" id="phone_no" name="phone_no" class="form-control" value="{{ old('phone_no', $due->phone_no) }}" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" class="form-control" step="0.01" value="{{ old('amount', $due->amount) }}" required>
        </div>

        <div class="form-group">
            <label for="info">Info</label>
            <textarea id="info" name="info" class="form-control">{{ old('info', $due->info) }}</textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $due->date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('due.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
