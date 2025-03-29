@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #36d1dc, #5b86e5);
        color: white;
    }
    .container {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container">
    <h1 class="my-4 text-center"><i class="bi bi-person-circle"></i> User Details</h1>
    <div class="card shadow-lg bg-light text-dark">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-person-fill"></i> {{ $user->name }}</h5>
            <p class="card-text"><strong><i class="bi bi-envelope-fill"></i> Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong><i class="bi bi-person-badge-fill"></i> Role:</strong> {{ ucfirst($user->role) }}</p>
            <p class="card-text"><strong><i class="bi bi-building"></i> Department:</strong> {{ $user->department ? $user->department->name : 'N/A' }}</p>

            <div class="mt-3">
                @can('update', $user)
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-fill"></i> Edit
                    </a>
                @endcan

                @can('delete', $user)
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;" 
                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill"></i> Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
    <a href="{{ route('user.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>
@endsection
