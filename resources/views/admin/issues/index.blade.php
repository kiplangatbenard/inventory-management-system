@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #fbc2eb, #a6c1ee);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        margin-top: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-weight: 600;
        color: #34495e;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .table-striped tbody tr:hover {
        background-color: #f3f9ff;
    }

    .form-control {
        font-size: 0.9rem;
        padding: 0.375rem 0.75rem;
    }

    .btn i {
        margin-right: 5px;
    }

    .badge {
        padding: 0.45em 0.75em;
        font-size: 0.85em;
        border-radius: 0.5rem;
    }
</style>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container">
    <div class="card-custom">
        <h2><i class="fas fa-exclamation-triangle"></i> Reported Issues</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <table class="table table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th><i class="fas fa-user"></i> User</th>
                    <th><i class="fas fa-laptop-code"></i> Gadget</th>
                    <th><i class="fas fa-heading"></i> Title</th>
                    <th><i class="fas fa-align-left"></i> Description</th>
                    <th><i class="fas fa-circle-info"></i> Status</th>
                    <th><i class="fas fa-cogs"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($issues as $issue)
                    <tr>
                        <td>{{ $issue->user->name }}</td>
                        <td>{{ $issue->gadget->name }}</td>
                        <td>{{ $issue->issue_title }}</td>
                        <td>{{ $issue->issue_description }}</td>
                        <td>
                            @if($issue->status === 'Pending')
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> {{ $issue->status }}</span>
                            @elseif($issue->status === 'Resolved')
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> {{ $issue->status }}</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.issues.updateStatus', $issue->id) }}" method="POST">
                                @csrf
                                <div class="d-flex flex-column">
                                    <select name="status" class="form-control mb-2" required>
                                        <option value="Pending" {{ $issue->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-sync-alt"></i> Update Status
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
