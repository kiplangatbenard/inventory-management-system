@extends('layouts.app')

@section('content')

<!-- Inline CSS for styling -->
<style>
    body {
        background: linear-gradient(to right, #1e3c72, #2a5298);
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-custom {
        background: rgba(0, 0, 0, 0.75);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }

    .form-group label {
        color: #ffc107;
        font-size: 1.1rem;
    }

    .form-group .form-control {
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        border: 1px solid #444;
        background-color: #222;
        color: #fff;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }

    .btn-primary {
        background-color: #ffc107;
        color: #1e3c72;
        border: none;
        padding: 10px 20px;
        font-size: 1.1rem;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #e0a800;
        color: #fff;
    }

    .btn-primary:focus {
        outline: none;
    }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

<section id="request-return" class="my-5 container">
    <h2>
        <a href="{{ route('user.dashboard') }}" class="back-btn">
            <i class="bi bi-arrow-left-circle-fill"></i> Back 
        </a>
        
    <h2><i class="bi bi-arrow-counterclockwise text-warning"></i> Gadget Return Request</h2>
    
    <div class="card card-custom">
        <div class="card-body">
            <form action="{{ route('user.returns.store') }}" method="POST">
                @csrf

                <!-- Select Gadget -->
                <div class="form-group">
                    <label for="gadget_id"><i class="bi bi-laptop"></i> Select Gadget:</label>
                    <select name="gadget_id" id="gadget_id" class="form-control" required>
                        <option value="">Select Gadget</option>
                        @foreach($gadgets as $gadget)
                            <option value="{{ $gadget->id }}">{{ $gadget->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Reason for Return -->
                <div class="form-group">
                    <label for="reason"><i class="bi bi-pencil-square"></i> Reason for Return:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="bi bi-arrow-right-circle"></i> Submit Return Request
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
