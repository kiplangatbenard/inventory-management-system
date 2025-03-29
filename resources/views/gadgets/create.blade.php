@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        color: white;
    }
    .container {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container">
    <a href="{{ route('gadgets.index') }}" class="btn btn-outline-light mb-3">
        <i class="bi bi-arrow-left"></i> Back
    </a>
    <h1 class="my-4 text-primary"><i class="bi bi-plus-circle"></i> Add New Gadget</h1>
    
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg bg-light text-dark">
        <div class="card-body">
            <form action="{{ route('gadgets.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter gadget name" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label fw-bold">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="" disabled selected>Select type</option>
                        <option value="phone">Phone</option>
                        <option value="laptop">Laptop</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="serial_number" class="form-label fw-bold">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Enter serial number" required>
                </div>
                <div class="mb-3">
                    <label for="condition" class="form-label fw-bold">Condition</label>
                    <select class="form-select" id="condition" name="condition" required>
                        <option value="" disabled selected>Select condition</option>
                        <option value="new">New</option>
                        <option value="used">Used</option>
                        <option value="damaged">Damaged</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-check-lg"></i> Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
