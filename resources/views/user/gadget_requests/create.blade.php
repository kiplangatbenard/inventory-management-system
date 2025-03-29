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

    <h2 class="mb-4"><i class="bi bi-clipboard-check"></i> Request a Gadget</h2>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <form action="{{ route('user.gadget_requests.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="gadget_type" class="form-label"><i class="bi bi-laptop"></i> Type of Gadget:</label>
                    <select name="gadget_type" id="gadget_type" class="form-select" required>
                        <option value="Laptop">Laptop</option>
                        <option value="Phone">Phone</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="gadget_id" class="form-label"><i class="bi bi-box"></i> Select Gadget:</label>
                    <select name="gadget_id" id="gadget_id" class="form-select" required>
                        @foreach ($gadgets as $gadget)
                            <option value="{{ $gadget->id }}">{{ $gadget->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label"><i class="bi bi-chat-left-text"></i> Reason for Request:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="4" placeholder="Explain why you need this gadget..." required></textarea>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-send"></i> Submit Request
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
