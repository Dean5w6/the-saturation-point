<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    { 
        $statuses = ['completed', 'completed', 'completed', 'completed', 'shipped', 'pending', 'cancelled'];
        $userIds = User::where('role', 'customer')->pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();
 
        for ($i = 0; $i < 50; $i++) {
             
            $daysToSubtract = rand(1, 730); 
            $date = Carbon::now()->subDays($daysToSubtract);
            
            $order = Order::create([
                'user_id' => $userIds[array_rand($userIds)],
                'status' => $statuses[array_rand($statuses)],
                'total_price' => 0, 
                'created_at' => $date,
                'updated_at' => $date
            ]);

            $total = 0;
            $itemCount = rand(1, 3);
            for ($j = 0; $j < $itemCount; $j++) {
                $product = Product::find($productIds[array_rand($productIds)]);
                $qty = rand(1, 2);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
                $total += ($product->price * $qty);
            }
            $order->update(['total_price' => $total]);
        }
    }
}