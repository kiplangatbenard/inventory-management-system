@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: #fff;
    }
    .container {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
    }
    .table {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    .table th, .table td {
        border-color: rgba(255, 255, 255, 0.3);
    }
    .btn {
        transition: all 0.3s ease;
    }
</style>

<div class="container">
    <!-- Back Button -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light mb-3">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>

    <h1 class="my-4"><i class="bi bi-people"></i> User Management</h1>
    <a href="{{ route('user.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-person-plus"></i> Add New User
    </a>

    @if($users->count())
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th><i class="bi bi-person"></i> Name</th>
                        <th><i class="bi bi-envelope"></i> Email</th>
                        <th><i class="bi bi-shield-lock"></i> Role</th>
                        <th><i class="bi bi-building"></i> Department</th>
                        <th><i class="bi bi-gear"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->department ? $user->department->name : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center">No users found.</p>
    @endif
</div>
@endsection