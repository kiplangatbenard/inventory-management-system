@extends('layouts.user')

@section('content')
<main class="container mt-4">
    <h2><i class="bi bi-arrow-return-left"></i> Return Gadget</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card bg-dark text-white shadow">
        <div class="card-body">
        <form action="{{ route('user.gadget.return') }}" method="POST">


                <div class="mb-3">
                    <label for="gadget_id" class="form-label"><i class="bi bi-laptop"></i> Select Gadget to Return</label>
                    <select class="form-control" id="gadget_id" name="gadget_id" required>
                        @foreach ($assignedGadgets as $gadget)
                            <option value="{{ $gadget->id }}">{{ $gadget->name }} ({{ $gadget->serial_number }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="return_reason" class="form-label"><i class="bi bi-chat-left-text"></i> Reason for Return</label>
                    <textarea class="form-control" id="return_reason" name="return_reason" placeholder="Why are you returning this gadget?" required></textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-arrow-return-left"></i> Request Return
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
