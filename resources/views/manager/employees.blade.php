@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-primary"><i class="bi bi-people"></i> Employee Allocations</h1>
    <table class="table table-bordered bg-white text-dark">
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
@endsection
