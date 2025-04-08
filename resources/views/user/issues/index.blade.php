@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #a1c4fd, #c2e9fb);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-custom {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        margin-top: 40px;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn i {
        margin-right: 5px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .table-striped tbody tr:hover {
        background-color: #f1f9ff;
    }

    .badge {
        padding: 0.4em 0.75em;
        font-size: 0.85em;
        border-radius: 0.5rem;
    }
</style>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container">
    <div class="card-custom">
        <!-- Report button -->
        <a href="{{ route('user.issues.create', ['id']) }}" class="btn btn-success mb-4">
            <i class="fas fa-plus-circle"></i> Report New Issue
        </a>

        <h2><i class="fas fa-bug"></i> My Reported Issues</h2>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th><i class="fas fa-laptop"></i> Gadget</th>
                    <th><i class="fas fa-heading"></i> Title</th>
                    <th><i class="fas fa-align-left"></i> Description</th>
                    <th><i class="fas fa-info-circle"></i> Status</th>
                    <th><i class="fas fa-clock"></i> Reported At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($issues as $issue)
                    <tr>
                        <td>{{ $issue->gadget->name }}</td>
                        <td>{{ $issue->issue_title }}</td>
                        <td>{{ $issue->issue_description }}</td>
                        <td>
                            @if($issue->status === 'Pending')
                                <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> {{ $issue->status }}</span>
                            @elseif($issue->status === 'Resolved')
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> {{ $issue->status }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $issue->status }}</span>
                            @endif
                        </td>
                        <td>{{ $issue->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
