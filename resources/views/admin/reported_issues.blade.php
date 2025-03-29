@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Reported Gadget Issues</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Gadget</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Reported At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($issues as $issue)
                    <tr>
                        <td>{{ $issue->id }}</td>
                        <td>{{ $issue->user->name }}</td>
                        <td>{{ $issue->gadget->name }}</td>
                        <td>{{ $issue->description }}</td>
                        <td>
                            <span class="badge bg-{{ $issue->status == 'resolved' ? 'success' : 'warning' }}">
                                {{ ucfirst($issue->status) }}
                            </span>
                        </td>
                        <td>{{ $issue->created_at->format('d M Y, H:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
