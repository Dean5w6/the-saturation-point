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
        <div class="card bg-white text-center p-4 h-100 shadow-sm">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">₱{{ number_format($totalSales, 2) }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">Total Sales</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">{{ $newOrders }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">New Orders</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">{{ $totalProducts }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">Products</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-white text-center p-4 h-100 shadow-sm">
            <h1 class="display-4 fw-bold font-playfair" style="color: var(--ink-blue);">{{ $totalCustomers }}</h1>
            <p class="text-muted text-uppercase small ls-1 mb-0">Customers</p>
        </div>
    </div>
</div>
 
<div class="row g-4"> 
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex justify-content-end align-items-center mb-3 gap-2">
                    <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}">
                    <span>to</span>
                    <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}">
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </form>
                <canvas id="dailySalesChart"></canvas>
            </div>
        </div>
    </div>
 
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
    </div>
 
    <div class="col-lg-12">
        <div class="card shadow-sm">
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
                backgroundColor: 'rgba(15, 23, 42, 0.8)',
                borderColor: 'rgba(15, 23, 42, 1)',
                borderWidth: 1
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
        type: 'pie',
        data: {
            labels: {!! json_encode($topProducts->keys()) !!},
            datasets: [{
                label: 'Top Selling Products',
                data: {!! json_encode($topProducts->values()) !!},
                backgroundColor: ['#0f172a', '#c6a87c', '#64748b', '#94a3b8', '#cbd5e1'],
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Top 5 Products by Sales' } }
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
                fill: false,
                borderColor: 'rgb(198, 168, 124)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Sales This Year' } }
        }
    });
</script>
@endsection