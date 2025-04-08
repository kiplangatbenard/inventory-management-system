@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f1f2b5, #135058);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }

    h2 {
        font-weight: 600;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .table-striped tbody tr:hover {
        background-color: #f4f9fb;
    }

    .btn i {
        margin-right: 5px;
    }

    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.9em;
        border-radius: 0.5rem;
    }
</style>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container">
    <div class="card-custom">
        <h2><i class="fas fa-clipboard-list"></i> Gadget Return Requests</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <table class="table table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th><i class="fas fa-microchip"></i> Gadget Name</th>
                    <th><i class="fas fa-comment-dots"></i> Reason</th>
                    <th><i class="fas fa-hourglass-half"></i> Status</th>
                    <th><i class="fas fa-calendar-day"></i> Requested At</th>
                    <th><i class="fas fa-cogs"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($returns as $return)
                    <tr>
                        <td>{{ $return->gadget->name }}</td>
                        <td>{{ $return->reason }}</td>
                        <td>
                            @if($return->status === 'Pending')
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> {{ $return->status }}</span>
                            @elseif($return->status === 'Approved')
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> {{ $return->status }}</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-times-circle"></i> {{ $return->status }}</span>
                            @endif
                        </td>
                        <td>{{ $return->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            @if($return->status == 'Pending')
                                <form action="{{ route('admin.returns.approve', $return->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.returns.reject', $return->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-secondary">{{ $return->status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
