@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Backward Arrow -->
            <div class="mb-3 text-start">
                <a href="javascript:history.back()" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white fw-bold">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="fw-bold">{{ __('You are logged in!') }}</h5>
                    <p class="text-muted">Welcome to the inventory management system. Navigate through the system to manage inventory efficiently.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
