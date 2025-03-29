@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #e3f2fd;
    }
    .card {
        border-radius: 15px;
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: scale(1.05);
    }
</style>

<div class="container py-4">
    <!-- Backward Button -->
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary mb-3">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    
    <h1 class="my-4 text-primary fw-bold"><i class="fas fa-chart-line"></i> Reports</h1>
    
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <i class="fas fa-laptop fa-3x text-primary"></i>
                    <h5 class="card-title mt-3 text-secondary">Allocated Gadgets</h5>
                    <p class="card-text display-4 fw-bold text-dark">{{ $allocatedGadgets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <i class="fas fa-box-open fa-3x text-success"></i>
                    <h5 class="card-title mt-3 text-secondary">Available Gadgets</h5>
                    <p class="card-text display-4 fw-bold text-dark">{{ $availableGadgets }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
