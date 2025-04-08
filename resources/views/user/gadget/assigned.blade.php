@extends('user.layout')

@section('content')

<!-- Inline CSS for this page -->
<style>
    body {
        background: linear-gradient(to right, #2c3e50, #4ca1af);
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
        font-weight: 600;
        margin-bottom: 20px;
    }

    .card-custom {
        border-radius: 15px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        padding: 25px;
    }

    table {
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        vertical-align: middle !important;
    }

    th i, td i {
        margin-right: 8px;
    }

    .no-data {
        font-size: 1.5rem;
        padding: 20px 0;
        text-align: center;
        color: #ffc107;
    }

    .back-icon {
        font-size: 1.5rem;
        color: #fff;
        transition: color 0.3s ease;
    }

    .back-icon:hover {
        color: #ffc107;
    }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

<section id="gadget-details" class="my-5 container">
    <h2>
<!-- Back Button -->
<a href="{{ route('user.dashboard') }}" class="back-btn">
        <i class="bi bi-arrow-left-circle-fill"></i> Back 
    </a>
        <i class="bi bi-info-circle-fill text-warning"></i> Gadget Details
    </h2>

    <div class="card card-custom">
        <div class="card-body">
            @if ($assignedGadgets->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover text-center align-middle" style="font-size: 1.1rem;">
                        <thead class="table-light text-dark">
                            <tr>
                                <th><i class="bi bi-laptop"></i> Gadget Name</th>
                                <th><i class="bi bi-upc-scan"></i> Serial Number</th>
                                <th><i class="bi bi-shield-check"></i> Condition</th>
                                <th><i class="bi bi-info-circle"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedGadgets as $gadget)
                                <tr>
                                    <td>{{ $gadget->name }}</td>
                                    <td>{{ $gadget->serial_number }}</td>
                                    <td>{{ ucfirst($gadget->condition) }}</td>
                                    <td>
                                        @if(strtolower($gadget->status) === 'active')
                                            <span class="badge bg-success">{{ ucfirst($gadget->status) }}</span>
                                        @elseif(strtolower($gadget->status) === 'inactive')
                                            <span class="badge bg-secondary">{{ ucfirst($gadget->status) }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ ucfirst($gadget->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="no-data">
                    <i class="bi bi-exclamation-circle-fill"></i> No gadgets assigned.
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
