@extends('user.layout')

@section('content')

<section id="gadget-details" class="my-4">
    <h2 style="font-size: 2rem;">
        <a href="{{ url()->previous() }}" class="text-white text-decoration-none">
            <i class="bi bi-arrow-left"></i>
        </a>
        <i class="bi bi-info-circle-fill"></i> Gadget Details
    </h2>

    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            @if ($assignedGadgets->isNotEmpty())
                <table class="table table-dark table-striped table-hover text-center" style="font-size: 1.25rem;">
                    <thead>
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
                                <td>{{ ucfirst($gadget->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="font-size: 1.5rem;">No gadgets assigned.</p>
            @endif
        </div>
    </div>
</section>

@endsection
