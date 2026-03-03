<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Product::select('brand')->distinct()->pluck('brand');

        $query = Product::query();

        if ($request->filled('search')) {
            
            $scout = Product::search($request->search);
            
            $scout->query(function ($builder) use ($request) {
                $builder->with('category'); 
                $this->applyFilters($builder, $request);
            });
            $products = $scout->paginate(9)->withQueryString();
        } 
        
        else {
            $query->with('category');
            $this->applyFilters($query, $request);
            $products = $query->latest()->paginate(9)->withQueryString();
        }

        return view('welcome', compact('products', 'categories', 'brands'));
    }
    
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    }

    public function show($id)
    {
        $product = Product::with(['category', 'images', 'reviews' => function($query) {
            $query->orderByRaw("user_id = ? DESC", [auth()->id()])->orderBy('created_at', 'desc');
        }, 'reviews.user'])->findOrFail($id);
        
        return view('products.show', compact('product'));
    }
}