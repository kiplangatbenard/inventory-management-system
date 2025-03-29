@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Gadget Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $gadget->name }}</h5>
            <p class="card-text"><strong>Type:</strong> {{ ucfirst($gadget->type) }}</p>
            <p class="card-text"><strong>Serial Number:</strong> {{ $gadget->serial_number }}</p>
            <p class="card-text"><strong>Condition:</strong> {{ ucfirst($gadget->condition) }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($gadget->status) }}</p>
            <a href="{{ route('gadgets.edit', $gadget->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('gadgets.destroy', $gadget->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('gadgets.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection