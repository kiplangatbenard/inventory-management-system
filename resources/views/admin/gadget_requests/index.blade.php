@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-laptop-code me-2"></i>Gadget Requests</h2>

    @if ($requests->isEmpty())
        <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>No gadget requests found.</div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><i class="fas fa-user me-1"></i>User</th>
                        <th><i class="fas fa-tags me-1"></i>Type</th>
                        <th><i class="fas fa-microchip me-1"></i>Gadget</th>
                        <th><i class="fas fa-comment-dots me-1"></i>Reason</th>
                        <th><i class="fas fa-check-circle me-1"></i>Status</th>
                        <th><i class="fas fa-clock me-1"></i>Requested On</th>
                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->user->name ?? 'Unknown User' }}</td>
                            <td>{{ $request->gadget_type }}</td>
                            <td>{{ optional($request->gadget)->name ?? 'Not Found' }}</td>
                            <td>{{ $request->reason }}</td>
                            <td>
                                @if ($request->status === 'approved')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Approved</span>
                                @elseif ($request->status === 'rejected')
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i>Pending</span>
                                @endif
                            </td>
                            <td>{{ $request->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                @if($request->status == 'pending')
                                    <form action="{{ route('admin.gadget_requests.update', $request->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-success me-1">
                                            <i class="fas fa-thumbs-up"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.gadget_requests.update', $request->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-thumbs-down"></i> Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted"><i class="fas fa-eye me-1"></i>Reviewed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
