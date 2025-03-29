@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        color: white;
    }
    .container {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container">
    <h1 class="my-4 text-primary"><i class="bi bi-tools"></i> Gadgets</h1>

    <!-- Back to Dashboard Button -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light mb-3">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>

    <a href="{{ route('gadgets.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Add New Gadget
    </a>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle bg-light text-dark">
            <thead class="table-dark">
                <tr>
                    <th><i class="bi bi-laptop"></i> Name</th>
                    <th><i class="bi bi-tag"></i> Type</th>
                    <th><i class="bi bi-upc-scan"></i> Serial Number</th>
                    <th><i class="bi bi-clipboard-check"></i> Condition</th>
                    <th><i class="bi bi-gear"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gadgets as $gadget)
                    <tr>
                        <td>{{ $gadget->name }}</td>
                        <td>{{ $gadget->type }}</td>
                        <td>{{ $gadget->serial_number }}</td>
                        <td>
    <span class="badge {{ strtolower($gadget->condition) === 'new' ? 'bg-success' : (strtolower($gadget->condition) === 'used' ? 'bg-warning' : 'bg-danger') }}">
        {{ ucfirst($gadget->condition) }}
    </span>
</td>

                        <td>
                            <a href="{{ route('gadgets.show', $gadget->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('gadgets.edit', $gadget->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('gadgets.destroy', $gadget->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gadget?');">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection