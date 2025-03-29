@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5 gradient-bg text-white py-5 rounded shadow">
        
        <!-- Company Logo -->
        <div class="mb-4">
            <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo - Inventory Management System" 
                 class="img-fluid rounded shadow-sm" style="max-height: 100px;">
        </div>
        
        <!-- Welcome Message -->
        <h1 class="fw-bold">Welcome to the Inventory Management System</h1>
        <p class="text-light">Track and manage your inventory efficiently.</p>

        <!-- Login Button -->
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 shadow">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
        }
    </style>
@endsection
