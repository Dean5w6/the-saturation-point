<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public $createdCount = 0;
    public $updatedCount = 0;

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            throw new \Exception("The uploaded file is empty.");
        }

        $firstRow = $rows->first()->toArray();
        $requiredHeaders = ['name', 'category', 'brand', 'description', 'price', 'stock'];
        
        foreach ($requiredHeaders as $header) {
            if (!array_key_exists($header, $firstRow)) {
                throw new \Exception("Missing required column header: '{$header}'. Please check your Excel file.");
            }
        }

        foreach ($rows as $row) {
            if (empty($row['name'])) {
                continue;
            }

            $category = Category::firstOrCreate(['name' => $row['category']]);

            $existingProduct = Product::where('name', $row['name'])
                ->where('brand', $row['brand'])
                ->where('category_id', $category->id)
                ->first();

            if ($existingProduct) {
                $existingProduct->update([
                    'description' => $row['description'],
                    'price'       => $row['price'],
                    'stock'       => $row['stock'],
                ]);
                $this->updatedCount++;
            } else {
                Product::create([
                    'category_id' => $category->id,
                    'name'        => $row['name'],
                    'brand'       => $row['brand'],
                    'description' => $row['description'],
                    'price'       => $row['price'],
                    'stock'       => $row['stock'],
                    'img_path'    => null,
                ]);
                $this->createdCount++;
            }
        }
    }
}