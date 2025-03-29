@extends('user.layout')

@section('content')

<section id="user-details" class="my-4">
    <h2><i class="bi bi-person-circle"></i> User Details</h2>
    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            <p><i class="bi bi-person"></i> <strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><i class="bi bi-envelope"></i> <strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><i class="bi bi-building"></i> <strong>Department:</strong> {{ optional(auth()->user()->department)->name ?? 'N/A' }}</p>
        </div>
    </div>
</section>

@endsection
