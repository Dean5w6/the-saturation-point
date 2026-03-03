<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceipt;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        
        foreach($cart as $id => &$details) {
            $product = Product::find($id);
            if($product) {
                $details['stock'] = $product->stock; 
                if($details['quantity'] > $product->stock) {
                    $details['quantity'] = $product->stock;
                }
            }
        }
        Session::put('cart', $cart);

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        if($request->quantity > $product->stock) {
            return back()->with('error', "Insufficient stock. Only {$product->stock} units available.");
        }

        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'img_path' => $product->img_path
        ];

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function updateQuantity(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);
        
        $newQty = $request->quantity;
        if($newQty > $product->stock) $newQty = $product->stock;
        if($newQty < 1) $newQty = 1;

        $cart[$id]['quantity'] = $newQty;
        Session::put('cart', $cart);
        return back()->with('success', 'Quantity updated.');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return back()->with('success', 'Item removed from cart.');
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);
        $selectedIds = $request->input('selected_items', []);

        if(empty($selectedIds)) {
            return back()->with('error', 'Please select at least one item to checkout.');
        }

        DB::beginTransaction(); 

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => 0 
            ]);

            $total = 0;
            
            foreach($selectedIds as $id) {
                $product = Product::lockForUpdate()->find($id);
                $qty = $cart[$id]['quantity'];

                if($product->stock < $qty) {
                    throw new \Exception("Stock for {$product->name} changed. Please refresh cart.");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $qty,
                    'price' => $product->price
                ]);

                $product->decrement('stock', $qty);
                $total += ($product->price * $qty);
                
                unset($cart[$id]);
            }

            $order->update(['total_price' => $total]);
            Session::put('cart', $cart);
            DB::commit(); 
 
            $orderWithRelations = Order::with(['user', 'items.product'])->find($order->id);
            Mail::to(Auth::user()->email)->send(new OrderReceipt($orderWithRelations));

            return redirect()->route('orders.history')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback(); 
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}