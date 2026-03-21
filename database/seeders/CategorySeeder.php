<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Fountain Pens', 'description' => 'Luxury writing instruments.']);
        Category::create(['name' => 'Inks', 'description' => 'Bottled fountain pen inks.']);
        Category::create(['name' => 'Paper', 'description' => 'Fountain pen friendly notebooks.']);
        Category::create(['name' => 'Accessories', 'description' => 'Pen cases, sleeves, and stands.']);
        Category::create(['name' => 'Maintenance', 'description' => 'Cleaning kits and tuning supplies.']);
    }
}