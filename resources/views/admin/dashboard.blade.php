@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4 text-white fw-bold text-center">Admin Dashboard</h1>

    <div class="row">
        <!-- Total Gadgets -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 bg-gradient-info text-white">
                <div class="card-body text-center">
                    <i class="fas fa-desktop fa-2x"></i>
                    <h6 class="card-title mt-2">Total Gadgets</h6>
                    <p class="card-text fs-4 fw-semibold">{{ $totalGadgets }}</p>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 bg-gradient-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x"></i>
                    <h6 class="card-title mt-2">Total Users</h6>
                    <p class="card-text fs-4 fw-semibold">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

<!-- Pending Requests -->
<div class="col-md-3">
    <div class="card shadow-lg border-0 bg-gradient-warning text-white">
        <div class="card-body text-center">
            <i class="fas fa-hourglass-half fa-2x"></i>
            <h6 class="card-title mt-2">Pending Requests</h6>
            <p class="card-text fs-4 fw-semibold">{{ $pendingRequestsCount }}</p>
            </a>
        </div>
    </div>
</div>



        <!-- Allocated Gadgets -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 bg-gradient-primary text-white">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x"></i>
                    <h6 class="card-title mt-2">Allocated Gadgets</h6>
                    <p class="card-text fs-4 fw-semibold">{{ $allocatedGadgets }}</p>
                </div>
            </div>
        </div>
    </div>
    




    <!-- New Charts Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 bg-light">
                <div class="card-body">
                    <h6 class="card-title text-primary text-center">Gadget Usage</h6>
                    <canvas id="gadgetUsageChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0 bg-light">
                <div class="card-body">
                    <h6 class="card-title text-primary text-center">Issue Trends</h6>
                    <canvas id="issueTrendsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
    }

    .bg-gradient-info { background: linear-gradient(135deg, #17a2b8, #138496); }
    .bg-gradient-success { background: linear-gradient(135deg, #28a745, #1e7e34); }
    .bg-gradient-warning { background: linear-gradient(135deg, #ffc107, #d39e00); }
    .bg-gradient-primary { background: linear-gradient(135deg, #007bff, #0056b3); }
</style>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ensure PHP data is properly injected into JavaScript
        let gadgetUsageLabels = @json(array_keys($gadgetUsage->toArray()));
        let gadgetUsageData = @json(array_values($gadgetUsage->toArray()));

        let issueTrendsLabels = @json(array_keys($issueTrends->toArray()));
        let issueTrendsData = @json(array_values($issueTrends->toArray()));

        // Gadget Usage Chart
        const gadgetUsageCtx = document.getElementById('gadgetUsageChart').getContext('2d');
        new Chart(gadgetUsageCtx, {
            type: 'bar',
            data: {
                labels: gadgetUsageLabels,
                datasets: [{
                    label: 'Usage Count',
                    data: gadgetUsageData,
                    backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545']
                }]
            }
        });

        // Issue Trends Chart
        const issueTrendsCtx = document.getElementById('issueTrendsChart').getContext('2d');
        new Chart(issueTrendsCtx, {
            type: 'line',
            data: {
                labels: issueTrendsLabels,
                datasets: [{
                    label: 'Reported Issues',
                    data: issueTrendsData,
                    borderColor: '#dc3545',
                    fill: false
                }]
            }
        });
    });
</script>
@endsection