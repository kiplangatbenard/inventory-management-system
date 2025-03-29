@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="bi bi-laptop"></i> Available Gadgets</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($gadgets as $gadget)
            <div class="col-md-4">
                <div class="card shadow-lg bg-light">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-device-laptop"></i> {{ $gadget->name }}</h5>
                        <p><strong>Type:</strong> {{ ucfirst($gadget->type) }}</p>
                        <p><strong>Serial:</strong> {{ $gadget->serial_number }}</p>
                        <p><strong>Condition:</strong> {{ ucfirst($gadget->condition) }}</p>
                        
                        <!-- Request Form -->
                        <form action="{{ route('user.gadgets.request') }}" method="POST">
                            @csrf
                            <input type="hidden" name="gadget_id" value="{{ $gadget->id }}">
                            <div class="mb-2">
                                <label for="reason" class="form-label">Reason for Request</label>
                                <textarea class="form-control" name="reason" required placeholder="Why do you need this gadget?"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-send"></i> Request Gadget
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No available gadgets at the moment.</p>
        @endforelse
    </div>
</div>
@endsection

