@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h2 class="border-bottom pb-2 font-playfair" style="border-color: var(--gold-accent) !important;">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </h2>
    </div>
</div>
  
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm border-0">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">₱{{ number_format($totalSales, 2) }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">Total Sales</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm border-0">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">{{ $newOrders }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">New Orders</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm border-0">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">{{ $totalProducts }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">Products</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm border-0">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">{{ $totalCustomers }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">Customers</p>
        </div>
    </div>
</div>
 
<div class="row g-4"> 
    <div class="col-lg-8">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex justify-content-end align-items-center mb-3 gap-2">
                    <input type="date" name="start_date" class="form-control form-control-sm" style="border-radius: 2px;" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}">
                    <span class="text-muted small fw-bold">TO</span>
                    <input type="date" name="end_date" class="form-control form-control-sm" style="border-radius: 2px;" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}">
                    <button type="submit" class="btn btn-primary btn-sm px-3" style="border-radius: 2px;">FILTER</button>
                </form>
                <canvas id="dailySalesChart"></canvas>
            </div>
        </div>
    </div>
 
    <div class="col-lg-4">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body d-flex align-items-center">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
    </div>
 
    <div class="col-lg-6">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <canvas id="yearlySalesChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts') 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script> 
    const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
    new Chart(dailySalesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dailySales->keys()) !!},
            datasets: [{
                label: 'Daily Sales (PHP)',
                data: {!! json_encode($dailySales->values()) !!},
                backgroundColor: '#0f172a',
                borderRadius: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Sales by Date Range' } },
            scales: { y: { beginAtZero: true } }
        }
    });
 
    const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
    new Chart(topProductsCtx, {
        type: 'doughnut', // Changed to doughnut for a more premium look
        data: {
            labels: {!! json_encode($topProducts->keys()) !!},
            datasets: [{
                data: {!! json_encode($topProducts->values()) !!},
                backgroundColor: ['#0f172a', '#c6a87c', '#64748b', '#cbd5e1', '#e2e8f0'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Top Products by Sales' } }
        }
    });
 
    const yearlySalesCtx = document.getElementById('yearlySalesChart').getContext('2d');
    new Chart(yearlySalesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($yearlySales->keys()) !!},
            datasets: [{
                label: 'Yearly Sales (PHP)',
                data: {!! json_encode($yearlySales->values()) !!},
                backgroundColor: '#c6a87c',
                borderRadius: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Sales by Year' } },
            scales: { y: { beginAtZero: true } }
        }
    });

    const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(monthlySalesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlySales->keys()) !!},
            datasets: [{
                label: 'Monthly Sales for {{ date("Y") }} (PHP)',
                data: {!! json_encode($monthlySales->values()) !!},
                fill: true,
                backgroundColor: 'rgba(15, 23, 42, 0.05)',
                borderColor: '#0f172a',
                tension: 0.3,
                pointBackgroundColor: '#c6a87c'
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Sales This Year' } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection