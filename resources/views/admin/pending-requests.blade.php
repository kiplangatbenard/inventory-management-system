@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-white fw-bold text-center">Pending Gadget Requests</h1>

    @if($pendingRequests->isEmpty())
        <p class="text-white text-center">No pending requests at the moment.</p>
    @else
        <div class="row">
            @foreach ($pendingRequests as $request)
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 bg-gradient-dark text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $request->user->name }}</h5>
                            <p class="card-text">
                                <strong>Requested Gadget ID:</strong> {{ $request->gadget_id }} <br>
                                <strong>Description:</strong> {{ $request->description }} <br>
                                <strong>Requested On:</strong> {{ $request->created_at->format('d M Y, H:i A') }}
                            </p>

                            <!-- Approve Button -->
                            <form action="{{ route('admin.approveGadget', ['id' => $request->user_id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Approve Request
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
