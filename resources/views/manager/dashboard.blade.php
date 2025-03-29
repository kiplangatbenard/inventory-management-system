@extends('layouts.manager')

@section('content')
<div class="container">
    <h2 class="text-white"><i class="bi bi-speedometer2"></i> Department Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Gadgets</h5>
                    <h3>{{ $totalGadgets }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Pending Requests</h5>
                    <h3>{{ $pendingRequests }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Reported Issues</h5>
                    <h3>{{ $reportedIssues }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Returned Gadgets</h5>
                    <h3>{{ $returnedGadgets }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-4 d-flex justify-content-between">
        <a href="{{ route('manager.requestGadget') }}" class="btn btn-warning"><i class="bi bi-cart-plus"></i> Request Gadget</a>
        <a href="{{ route('manager.reportIssue') }}" class="btn btn-danger"><i class="bi bi-bug"></i> Report Issue</a>
        <a href="{{ route('manager.allocations') }}" class="btn btn-info"><i class="bi bi-people"></i> View Allocations</a>
        <a href="{{ route('manager.gadgets') }}" class="btn btn-primary"><i class="bi bi-laptop"></i> View Gadgets</a>
    </div>

    <!-- Recent Activity -->
    <div class="mt-4">
        <h4 class="text-white"><i class="bi bi-clock-history"></i> Recent Activity</h4>
        <ul class="list-group">
            @foreach ($recentActivities as $activity)
                <li class="list-group-item">{{ $activity->message }} - <small>{{ $activity->created_at->diffForHumans() }}</small></li>
            @endforeach
        </ul>
    </div>

    <!-- Table of Department Gadgets -->
    <div class="mt-4">
        <h4 class="text-white"><i class="bi bi-list"></i> Department Gadgets</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Gadget</th>
                    <th>Serial Number</th>
                    <th>Condition</th>
                    <th>Assigned User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gadgets as $gadget)
                    <tr>
                        <td>{{ $gadget->name }}</td>
                        <td>{{ $gadget->serial_number }}</td>
                        <td>{{ $gadget->condition }}</td>
                        <td>{{ $gadget->user->name ?? 'Not Assigned' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
