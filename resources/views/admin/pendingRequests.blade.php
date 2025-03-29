@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Pending Gadget Requests</h2>

    @if($users->isNotEmpty())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Pending Requests</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gadgetRequests->where('status', 'pending')->count() }}</td>
                        <td>
                            <a href="{{ route('admin.assignGadget', $user->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-arrow-right-circle"></i> Assign Gadget
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No pending gadget requests found.</p>
    @endif

</div>

@endsection
