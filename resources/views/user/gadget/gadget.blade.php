@extends('user.layout')

@section('content')

<section id="gadget-details" class="my-4">
    <h2><i class="bi bi-info-circle-fill"></i> Gadget Details</h2>
    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            @if ($assignedGadgets->isNotEmpty())
                <p><i class="bi bi-laptop"></i> <strong>Gadget Name:</strong> {{ $assignedGadgets->first()->name }}</p>
                <p><i class="bi bi-upc-scan"></i> <strong>Serial Number:</strong> {{ $assignedGadgets->first()->serial_number }}</p>
                <p><i class="bi bi-shield-check"></i> <strong>Condition:</strong> {{ ucfirst($assignedGadgets->first()->condition) }}</p>
                <p><i class="bi bi-info-circle"></i> <strong>Status:</strong> {{ ucfirst($assignedGadgets->first()->status) }}</p>
            @else
                <p>No gadgets assigned.</p>
            @endif
        </div>
    </div>
</section>

@endsection
