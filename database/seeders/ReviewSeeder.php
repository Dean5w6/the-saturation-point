<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            'Absolutely fantastic! Exceeded my expectations.',
            'Good quality, but a bit pricey for what it is.',
            'Writes like a dream. Highly recommend.',
            'The color is perfect, exactly what I was looking for.',
            'Fast shipping, great packaging, flawless item.'
        ];

        $userIds = User::where('role', 'customer')->pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Review::create([
                'user_id' => $userIds[array_rand($userIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'rating' => rand(3, 5),
                'comment' => $comments[array_rand($comments)],
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30))
            ]);
        }
    }
}