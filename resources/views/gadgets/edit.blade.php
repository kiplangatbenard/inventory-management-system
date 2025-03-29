@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Gadget</h1>
    <form action="{{ route('gadgets.update', $gadget->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $gadget->name }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="phone" {{ $gadget->type == 'phone' ? 'selected' : '' }}>Phone</option>
                <option value="laptop" {{ $gadget->type == 'laptop' ? 'selected' : '' }}>Laptop</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="serial_number" class="form-label">Serial Number</label>
            <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $gadget->serial_number }}" required>
        </div>
        <div class="mb-3">
            <label for="condition" class="form-label">Condition</label>
            <select class="form-control" id="condition" name="condition" required>
                <option value="new" {{ $gadget->condition == 'new' ? 'selected' : '' }}>New</option>
                <option value="used" {{ $gadget->condition == 'used' ? 'selected' : '' }}>Used</option>
                <option value="damaged" {{ $gadget->condition == 'damaged' ? 'selected' : '' }}>Damaged</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection