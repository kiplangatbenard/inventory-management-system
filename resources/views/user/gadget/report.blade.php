@extends('layouts.user')

@section('content')
<main class="container mt-4">
    <h2 class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Report Issue</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            <form action="{{ route('user.reportIssue') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="gadget_id" class="form-label"><i class="bi bi-laptop"></i> Select Gadget</label>
                    <select class="form-control" id="gadget_id" name="gadget_id" required>
                        <option value="" disabled selected>-- Choose a Gadget --</option>
                        @foreach ($assignedGadgets as $gadget)
                            <option value="{{ $gadget->id }}">{{ $gadget->name }} ({{ $gadget->serial_number }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="issue_description" class="form-label"><i class="bi bi-chat-left-text"></i> Describe the Issue</label>
                    <textarea class="form-control" id="issue_description" name="issue_description" rows="4" placeholder="Provide details about the issue..." required></textarea>
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-exclamation-circle"></i> Report Issue
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
