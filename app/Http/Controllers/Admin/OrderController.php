<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderStatusUpdated;

class OrderController extends Controller
{ 
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Order::with(['user', 'items.product'])->select('orders.*');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
                ->addColumn('customer', function($row){
                    return $row->user->name ?? 'Deleted User';
                })
                ->addColumn('items', function($row){
                    return $row->items->map(function($item){
                        return ($item->product->name ?? 'Unknown') . " (x" . $item->quantity . ")";
                    })->implode(', ');
                })
                ->editColumn('status', function($row){
                    $color = match($row->status) {
                        'pending'   => '#17a2b8',
                        'shipped'   => '#0d6efd',
                        'completed' => '#198754',
                        'cancelled' => '#dc3545',
                        default     => '#6c757d'
                    };
                    return '<span class="badge text-uppercase" style="background-color: '.$color.'; letter-spacing: 1px; font-size: 0.7rem; border-radius: 2px;">'.$row->status.'</span>';
                })
                ->editColumn('total_price', function($row){
                    return '₱' . number_format($row->total_price, 2);
                })
                ->editColumn('created_at', function($row){
                    return $row->created_at->format('Y-m-d');
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('admin.orders.show', $row->id).'" class="btn btn-primary btn-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 2px; height: 31px;">MANAGE</a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.orders.index');
    }
 
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
 
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        $newStatus = $request->status;
        $currentStatus = $order->status;

        if (in_array($currentStatus, ['completed', 'cancelled'])) {
            return back()->with('error', 'Finalized orders cannot be modified.');
        }

        if ($newStatus === 'shipped' && $currentStatus !== 'pending') {
            return back()->with('error', 'Only pending orders can be marked as shipped.');
        }

        if ($newStatus === 'completed' && $currentStatus !== 'shipped') {
            return back()->with('error', 'Orders must be marked as SHIPPED before they can be COMPLETED.');
        }

        if ($newStatus === 'completed') {
            DB::beginTransaction();
            try {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    if ($product->stock < $item->quantity) {
                        throw new \Exception("Insufficient stock for {$product->name}.");
                    } 
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', $e->getMessage());
            }
        }

        if ($newStatus === 'cancelled') {
            if ($currentStatus !== 'completed') {
                foreach ($order->items as $item) {
                    $item->product->increment('stock', $item->quantity);
                }
            }
        }

        $order->update(['status' => $newStatus]);
        Mail::to($order->user->email)->send(new OrderStatusUpdated($order));

        return back()->with('success', 'Order status updated successfully.');
    }
}