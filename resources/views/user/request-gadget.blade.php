@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(135deg, #4A90E2, #50E3C2);">
    <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; border-radius: 15px;">
        
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="btn btn-light mb-3">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <h2 class="text-center text-primary mb-4"><i class="fas fa-laptop"></i> Request a Gadget</h2>

        <form action="{{ route('user.requestGadget') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="gadget_type" class="form-label"><i class="fas fa-cogs"></i> Select Gadget Type</label>
                <select class="form-control shadow-sm" id="gadget_type" name="gadget_type" required>
                    <option value="laptop">💻 Laptop</option>
                    <option value="tablet">📱 Tablet</option>
                    <option value="mobile">📞 Mobile</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label"><i class="fas fa-comment-dots"></i> Reason for Request</label>
                <textarea class="form-control shadow-sm" id="reason" name="reason" rows="3" placeholder="Explain why you need this gadget..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-paper-plane"></i> Submit Request
            </button>
        </form>
    </div>
</div>
@endsection
