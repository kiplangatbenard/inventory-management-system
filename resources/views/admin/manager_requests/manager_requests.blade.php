@extends('layouts.admin')

@section('content')
<h2>Manager Gadget Requests</h2>
<table class="table">
    <thead>
        <tr>
            <th>Request ID</th>
            <th>Gadget</th>
            <th>Manager</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($managerRequests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->gadget->name }}</td>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->status }}</td>
            <td>
                <a href="{{ route('admin.approveRequest', $request->id) }}" class="btn btn-success">Approve</a>
                <a href="{{ route('admin.rejectRequest', $request->id) }}" class="btn btn-danger">Reject</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
