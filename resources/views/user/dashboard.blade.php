@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')

    @include('user.header')

    <!-- Gadget Summary Cards -->
    <div class="row text-center mb-4">
        @php
            $totalGadgets = $totalGadgets ?? 0;
            $assignedGadgetsCount = $assignedGadgetsCount ?? 0;
            $maintenanceGadgetsCount = $maintenanceGadgetsCount ?? 0;
        @endphp

        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card gadget-card bg-primary text-white shadow">
                <div class="card-body">
                    <h5><i class="bi bi-box-seam"></i> Total Gadgets</h5>
                    <h2>{{ $totalGadgets }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card gadget-card bg-success text-white shadow">
                <div class="card-body">
                    <h5><i class="bi bi-laptop"></i> Assigned Gadgets</h5>
                    <h2>{{ $assignedGadgetsCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card gadget-card bg-warning text-white shadow">
                <div class="card-body">
                    <h5><i class="bi bi-exclamation-triangle"></i> Under Maintenance</h5>
                    <h2>{{ $maintenanceGadgetsCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card shadow recent-activity">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-history"></i> Recent Activity</h5>
            @php
                $recentActivities = $recentActivities ?? collect([]); 
            @endphp

            @if($recentActivities->isNotEmpty())
                <ul class="list-unstyled">
                    @foreach($recentActivities as $activity)
                        <li><i class="bi bi-check-circle-fill text-success"></i> 
                            {{ $activity->description }} 
                            <small class="text-muted">({{ $activity->created_at->diffForHumans() }})</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted"><i class="bi bi-info-circle"></i> No recent activity available.</p>
            @endif
        </div>
    </div>

@endsection
