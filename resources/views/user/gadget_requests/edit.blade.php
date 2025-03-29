@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: white;
        min-height: 100vh;
    }
    .card {
        background: rgba(0, 0, 0, 0.8);
        color: white;
    }
</style>

<div class="container mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-light mb-3">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <h2 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Gadget Request</h2>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <form action="{{ route('user.gadget_requests.update', $request->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="gadget_type" class="form-label"><i class="bi bi-laptop"></i> Type of Gadget:</label>
                    <select name="gadget_type" id="gadget_type" class="form-select" required>
                        <option value="Laptop" {{ $request->gadget_type == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="Phone" {{ $request->gadget_type == 'Phone' ? 'selected' : '' }}>Phone</option>
                        <option value="Tablet" {{ $request->gadget_type == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                        <option value="Other" {{ $request->gadget_type == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="gadget_id" class="form-label"><i class="bi bi-box"></i> Select Gadget:</label>
                    <select name="gadget_id" id="gadget_id" class="form-select" required>
                        @foreach ($gadgets as $gadget)
                            <option value="{{ $gadget->id }}" {{ $request->gadget_id == $gadget->id ? 'selected' : '' }}>
                                {{ $gadget->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label"><i class="bi bi-chat-left-text"></i> Reason for Request:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="4" required>{{ $request->reason }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning btn-lg w-100">
                    <i class="bi bi-pencil"></i> Update Request
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
