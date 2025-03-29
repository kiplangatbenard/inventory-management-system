@extends('layouts.admin')

@section('content')
<div class="container p-4" style="background: linear-gradient(to right, #4b6cb7, #182848); border-radius: 10px; color: white;">
    <!-- Back Button -->
    <a href="{{ route('departments.index') }}" class="btn btn-light mb-3 shadow-sm">
        <i class="bi bi-arrow-left"></i> Back to Departments
    </a>

    <h1 class="my-4 fw-semibold">{{ $department->name }} Details</h1>

    <!-- Manager Card -->
    <div class="card shadow-lg border-0 mb-4">
        <div class="card-body">
            <h5 class="card-title text-primary"><i class="bi bi-person-badge"></i> Manager</h5>
            <p class="text-dark">
                {{ $department->manager ? $department->manager->name : 'No Manager Assigned' }}
            </p>
        </div>
    </div>

    <h4><i class="bi bi-people"></i> Employees</h4>
    <div class="row">
    @foreach($department->users as $user)
    <div class="col-md-4">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <h6 class="card-title text-dark"><i class="bi bi-person-circle"></i> {{ $user->name }}</h6>
                <p class="text-muted">
                    <i class="bi bi-laptop"></i> Gadgets Assigned: {{ $user->gadgets ? $user->gadgets->count() : 0 }}
                </p>
            </div>
        </div>
    </div>
@endforeach

    </div>
</div>
@endsection
