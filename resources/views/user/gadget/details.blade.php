@extends('user.layout')

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

    .card-custom p {
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    .card-custom i {
        color: #ffc107;
        margin-right: 10px;
    }

    strong {
        color: #ffc107;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        background-color: #ffc107;
        color: #1e3c72;
        border: none;
        padding: 10px 18px;
        font-weight: bold;
        border-radius: 8px;
        margin-bottom: 20px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .back-btn:hover {
        background-color: #e0a800;
        color: #fff;
    }

    .back-btn i {
        margin-right: 8px;
    }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

<section id="user-details" class="my-5 container">

    <!-- Back Button -->
    <a href="{{ route('user.dashboard') }}" class="back-btn">
        <i class="bi bi-arrow-left-circle-fill"></i> Back to Dashboard
    </a>

    <h2><i class="bi bi-person-circle text-warning"></i> User Details</h2>

    <div class="card card-custom">
        <div class="card-body">
            <p><i class="bi bi-person"></i> <strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><i class="bi bi-envelope"></i> <strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><i class="bi bi-building"></i> <strong>Department:</strong> {{ optional(auth()->user()->department)->name ?? 'N/A' }}</p>
        </div>
    </div>
</section>

@endsection
