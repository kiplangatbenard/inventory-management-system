@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Requests</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Gadget</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->gadget->name }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $request->type)) }}</td>
                    <td>{{ $request->description }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>
                        @if ($request->status === 'pending')
                            <form action="{{ route('admin.requests.approve', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.requests.reject', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection