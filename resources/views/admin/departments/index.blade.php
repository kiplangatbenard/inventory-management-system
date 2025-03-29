@extends('layouts.admin')

@section('content')
<div class="container p-4" style="background: linear-gradient(to right, #4b6cb7, #182848); border-radius: 10px; color: white;">
    <h1 class="my-4 fw-semibold"><i class="bi bi-buildings"></i> Departments</h1>

    <div class="row">
        @foreach($departments as $department)
        <div class="col-md-6">
            <div class="card shadow-lg border-0 mb-4" style="transition: transform 0.3s; border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="bi bi-diagram-3"></i> {{ $department->name }}</h5>
                    <p class="text-muted">
                        <i class="bi bi-person-badge"></i> Manager: 
                        <strong>{{ $department->manager ? $department->manager->name : 'Not Assigned' }}</strong>
                    </p>
                    <p class="text-dark"><i class="bi bi-people"></i> Employees: {{ $department->users->count() }}</p>
                    
                    <p class="text-dark"><i class="bi bi-laptop"></i> Gadgets Assigned: {{ $department->gadgets->count() }}</p>
                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info text-white">
                        <i class="bi bi-eye"></i> View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
