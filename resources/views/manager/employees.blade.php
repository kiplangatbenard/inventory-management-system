@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: linear-gradient(135deg, #0066cc, #0099ff); min-height: 100vh; padding: 2rem;">
    <div class="container bg-white p-4 rounded shadow">
        <a href="{{ route('manager.dashboard') }}" class="btn btn-outline-primary mb-3">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        <h1 class="text-primary mb-4"><i class="bi bi-people"></i> Department Employees & Approved Gadget Allocations</h1>

        <div class="table-responsive">
            <table class="table table-hover table-bordered bg-light text-dark rounded">
                <thead class="bg-primary text-white">
                    <tr>
                        <th><i class="bi bi-person"></i> Employee Name</th>
                        <th><i class="bi bi-envelope"></i> Email</th>
                        <th><i class="bi bi-laptop"></i> Approved Gadgets</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        @if ($user->approvedGadgets && $user->approvedGadgets->count() > 0)

                                <ul class="mb-0">
                                    @foreach ($user->approvedGadgets as $gadget)
                                        <li>
                                            {{ $gadget->name }} (SN: {{ $gadget->serial_number }})
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No approved gadgets</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No employees found in your department.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
