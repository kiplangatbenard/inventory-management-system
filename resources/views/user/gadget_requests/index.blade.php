@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: white;
        min-height: 100vh;
    }
    .card {
        background: rgba(0, 0, 0, 0.8);
        color: white;
    }
</style>

<div class="container mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-light mb-3">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <h2 class="mb-4"><i class="bi bi-clipboard-list"></i> My Gadget Requests</h2>

    <a href="{{ route('user.gadget_requests.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Request a Gadget
    </a>

    @if ($requests->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            <i class="bi bi-exclamation-circle"></i> No gadget requests found.
        </div>
    @else
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th><i class="bi bi-device-laptop"></i> Type</th>
                                <th><i class="bi bi-box"></i> Gadget</th>
                                <th><i class="bi bi-chat-left-text"></i> Reason</th>
                                <th><i class="bi bi-info-circle"></i> Status</th>
                                <th><i class="bi bi-calendar-check"></i> Requested On</th>
                                <th><i class="bi bi-gear"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ ucfirst($request->gadget_type) }}</td>
                                    <td>{{ optional($request->gadget)->name ?? 'Gadget Not Found' }}</td>
                                    <td>{{ $request->reason }}</td>
                                    <td>
                                        <span class="badge {{ $request->status == 'approved' ? 'bg-success' : ($request->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ ucfirst($request->status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td>{{ $request->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <a href="{{ route('user.gadget_requests.edit', $request->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('user.gadget_requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted"><i class="bi bi-lock-fill"></i> Not Editable</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
