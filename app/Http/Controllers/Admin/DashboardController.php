<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    { 
        $totalSales = Order::where('status', 'completed')->sum('total_price');
        $newOrders = Order::where('status', 'pending')->count();
        $totalProducts = \App\Models\Product::count();
        $totalCustomers = \App\Models\User::where('role', 'customer')->count();
 
        $yearlySales = Order::selectRaw('YEAR(created_at) as year, SUM(total_price) as total')
            ->where('status', 'completed')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->pluck('total', 'year');

        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->where('status', 'completed')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::create()->month($item->month)->format('F') => $item->total];
            });
 
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());

        $dailySales = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');
 
        $topProducts = OrderItem::selectRaw('products.name as product_name, SUM(order_items.quantity * order_items.price) as total_sales')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('products.name')
            ->orderBy('total_sales', 'desc')
            ->limit(5)
            ->pluck('total_sales', 'product_name');


        return view('admin.dashboard', compact(
            'totalSales', 'newOrders', 'totalProducts', 'totalCustomers',
            'yearlySales', 'monthlySales',
            'dailySales', 'startDate', 'endDate',
            'topProducts'
        ));
    }
}