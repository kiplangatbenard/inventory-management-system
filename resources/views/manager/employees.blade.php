@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: linear-gradient(135deg, #0066cc, #0099ff); min-height: 100vh; padding: 2rem;">
    <div class="container bg-white p-4 rounded shadow">
        <a href="{{ route('manager.dashboard') }}" class="btn btn-outline-primary mb-3">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        <h1 class="text-primary mb-4"><i class="bi bi-people"></i> Employee Allocations</h1>

        <table class="table table-hover table-bordered bg-light text-dark rounded">
            <thead class="bg-primary text-white">
                <tr>
                    <th><i class="bi bi-person"></i> Employee Name</th>
                    <th><i class="bi bi-laptop"></i> Gadgets Assigned</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ optional($user->gadgets)->count() ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
