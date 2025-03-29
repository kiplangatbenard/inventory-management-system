@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Gadget Requests</h2>

    @if ($requests->isEmpty())
        <p>No gadget requests found.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>User</th>
                    <th>Type</th>
                    <th>Gadget</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Requested On</th>
                    <th>Actions</th>
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
                                {{ ucfirst($request->status) }}
                        </td>
                        <td>{{ $request->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            @if($request->status == 'pending')
                                <form action="{{ route('admin.gadget_requests.update', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>

                                <form action="{{ route('admin.gadget_requests.update', $request->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @else
                                <span class="text-muted">Reviewed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
