<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productsData = [
            [1, 'Custom 823 Fountain Pen - Amber', 'Pilot', 16500.00, 15],
            [1, 'Lamy 2000 Fountain Pen', 'Lamy', 12500.00, 8],
            [1, 'Souverän M800 - Green/Black', 'Pelikan', 28000.00, 5],
            [1, 'Procyon - Deep Sea', 'Platinum', 3200.00, 25],
            [1, 'Eco - Clear Demonstrator', 'TWSBI', 1800.00, 40],
            [1, 'Homo Sapiens Bronze Age', 'Visconti', 45500.00, 3],
            [1, '1911 Large Fountain Pen', 'Sailor', 14500.00, 10],

            [2, 'Iroshizuku Kon-peki', 'Pilot', 1200.00, 50],
            [2, 'Iroshizuku Yama-budo', 'Pilot', 1200.00, 35],
            [2, 'Oxblood (80ml)', 'Diamine', 550.00, 60],
            [2, 'Aurora Borealis', 'Diamine', 550.00, 45],
            [2, 'Perle Noire (Black)', 'Aurora', 1100.00, 30],
            [2, 'Emerald of Chivor', 'J. Herbin', 1650.00, 12],
            [2, 'Irish Green', 'Montblanc', 1850.00, 15],

            [3, 'Tomoe River 52gsm A5', 'Hobonichi', 1400.00, 20],
            [3, 'Webnotebook A5', 'Rhodia', 1250.00, 30],
            [3, 'Mnemosyne Notebook A5', 'Maruman', 950.00, 25],
            [3, 'Midori MD Notebook - A5', 'Midori', 850.00, 40],
        ];

        foreach ($productsData as $p) {
            Product::create([
                'category_id' => $p[0],
                'name'        => $p[1],
                'brand'       => $p[2],
                'description' => 'A premium product for the discerning writer. High quality materials and exceptional craftsmanship. Perfect for your daily carry or desk setup.',
                'price'       => $p[3],
                'stock'       => $p[4],
                'img_path'    => null,
            ]);
        }
    }
}