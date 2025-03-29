@extends('layouts.admin')

@section('content')
<h2>Manager Gadget Allocations</h2>
<table class="table">
    <thead>
        <tr>
            <th>Manager</th>
            <th>Gadget</th>
            <th>Allocated Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($managerAllocations as $allocation)
        <tr>
            <td>{{ $allocation->user->name }}</td>
            <td>{{ $allocation->gadget->name }}</td>
            <td>{{ $allocation->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

