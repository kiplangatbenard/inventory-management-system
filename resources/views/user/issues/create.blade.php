@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #fdfcfb, #e2d1c3);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-form {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 35px;
        margin-top: 40px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    h2 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #555;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
    }

    .btn-submit {
        background: #1abc9c;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        color: white;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .btn-submit:hover {
        background: #16a085;
    }
</style>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container">
    <div class="card-form">
        <h2><i class="fas fa-exclamation-triangle"></i> Report Gadget Issue</h2>

        <!-- Issue Reporting Form -->
        <form action="{{ route('user.issues.store') }}" method="POST">
            @csrf

            <!-- Select Gadget -->
            <div class="form-group mb-3">
                <label for="gadget_id"><i class="fas fa-laptop"></i> Select Gadget:</label>
                <select name="gadget_id" id="gadget_id" class="form-control" required>
    <option value="">-- Choose Gadget --</option>
    @foreach($gadgets as $gadget)
        <option value="{{ $gadget->id }}">
            {{ $gadget->name }} - SN: {{ $gadget->serial_number }} ({{ ucfirst($gadget->condition) }})
        </option>
    @endforeach
</select>

            </div>

            <!-- Issue Title -->
            <div class="form-group mb-3">
                <label for="issue_title"><i class="fas fa-heading"></i> Issue Title:</label>
                <input type="text" name="issue_title" class="form-control" placeholder="Short summary..." required>
            </div>

            <!-- Issue Description -->
            <div class="form-group mb-3">
                <label for="issue_description"><i class="fas fa-align-left"></i> Issue Description:</label>
                <textarea name="issue_description" class="form-control" rows="4" placeholder="Describe the issue in detail..." required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit"><i class="fas fa-paper-plane"></i> Submit Report</button>
        </form>
    </div>
</div>
@endsection
