@extends('layouts.user')

@section('content')
<main class="container mt-4">
    <h2><i class="bi bi-laptop"></i> Assigned Gadgets</h2>

    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th><i class="bi bi-device-laptop"></i> Gadget Name</th>
                        <th><i class="bi bi-tools"></i> Type</th>
                        <th><i class="bi bi-upc-scan"></i> Serial Number</th>
                        <th><i class="bi bi-shield-check"></i> Condition</th>
                        <th><i class="bi bi-info-circle"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignedGadgets as $gadget)
                        <tr>
                            <td>{{ $gadget->name }}</td>
                            <td>{{ ucfirst($gadget->type) }}</td>
                            <td>{{ $gadget->serial_number }}</td>
                            <td>{{ ucfirst($gadget->condition) }}</td>
                            <td>{{ ucfirst($gadget->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No gadgets assigned</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
