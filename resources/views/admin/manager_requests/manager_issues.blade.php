@extends('layouts.admin')

@section('content')
<h2>Issues Reported by Managers</h2>
<table class="table">
    <thead>
        <tr>
            <th>Issue ID</th>
            <th>Manager</th>
            <th>Gadget</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($managerIssues as $issue)
        <tr>
            <td>{{ $issue->id }}</td>
            <td>{{ $issue->user->name }}</td>
            <td>{{ $issue->gadget->name }}</td>
            <td>{{ $issue->description }}</td>
            <td>{{ $issue->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
