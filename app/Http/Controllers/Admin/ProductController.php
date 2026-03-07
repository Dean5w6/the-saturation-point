<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{ 
    public function index(Request $request)
    {
        if ($request->ajax()) { 
            if ($request->filled('view_trash') && $request->view_trash == '1') {
                $query = Product::onlyTrashed()->with('category')->select('products.*');
            } else {
                $query = Product::with('category')->select('products.*');
            }

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            return DataTables::of($query)
                ->addColumn('category', function ($row) {
                    return $row->category->name ?? 'Uncategorized';
                }) 
                ->editColumn('price', function ($row) {
                    return '₱' . number_format($row->price, 2);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex gap-1 justify-content-start">';
                    if ($row->deleted_at) { 
                        $btn .= '<button class="btn btn-success btn-sm w-100 text-nowrap d-flex align-items-center justify-content-center restore-btn" data-id="'.$row->id.'" style="border-radius: 2px; height: 31px;">RESTORE</button>';
                    } else {
                        $btn .= '<a href="'.route('admin.products.edit', $row->id).'" class="btn btn-primary btn-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 2px; height: 31px;">EDIT</a>';
                        $btn .= '<button class="btn btn-danger btn-sm text-nowrap d-flex align-items-center justify-content-center delete-btn" data-id="'.$row->id.'" style="border-radius: 2px; height: 31px;">DELETE</button>';
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $categories = Category::all();
        return view('admin.products.index', compact('categories'));
    }
 
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'brand' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'img_path' => 'required|image|max:2048',
            'images.*' => 'image|max:2048'
        ]);
 
        if ($request->filled('new_category')) {
            $category = Category::firstOrCreate(['name' => $request->new_category]);
            $categoryId = $category->id;
        } else {
            if (!$request->filled('category_id')) {
                return back()->withErrors(['category_id' => 'Please select a category or create a new one.'])->withInput();
            }
            $categoryId = $request->category_id;
        }
 
        $duplicate = Product::withTrashed()
            ->where('name', $request->name)
            ->where('brand', $request->brand)
            ->where('category_id', $categoryId)
            ->first();

        if ($duplicate) {
            if ($duplicate->trashed()) {
                return back()->with('error', 'This product already exists but is in the Trash. Please restore it instead of creating a new one.')->withInput();
            }
            return back()->with('error', 'A product with this Name, Brand, and Category already exists.')->withInput();
        }

        $mainPath = $request->file('img_path')->store('products', 'public');

        $product = Product::create([
            'category_id' => $categoryId,
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_path' => $mainPath,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
 
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }
 
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'img_path' => 'nullable|image|max:2048',
            'images.*' => 'image|max:2048'
        ]);

        if ($request->filled('new_category')) {
            $category = Category::firstOrCreate(['name' => $request->new_category]);
            $product->category_id = $category->id;
        } elseif ($request->filled('category_id')) {
            $product->category_id = $request->category_id;
        }

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        
        $newMainImage = null;
        if ($request->hasFile('img_path')) {
            if ($product->img_path) { \Illuminate\Support\Facades\Storage::disk('public')->delete($product->img_path); }
            $product->img_path = $request->file('img_path')->store('products', 'public');
            $newMainImage = \Illuminate\Support\Facades\Storage::url($product->img_path);
        }

        $product->save();

        $newGalleryImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/gallery', 'public');
                $newImg = ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path
                ]);
                $newGalleryImages[] = [
                    'id' => $newImg->id,
                    'url' => \Illuminate\Support\Facades\Storage::url($path)
                ];
            }
        }
 
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!',
                'main_image' => $newMainImage,
                'new_gallery' => $newGalleryImages
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }
 
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product moved to trash.'
        ]);
    }

    public function restore($id)
    {
        $productToRestore = Product::withTrashed()->findOrFail($id);
 
        $activeDuplicate = Product::where('name', $productToRestore->name)
            ->where('brand', $productToRestore->brand)
            ->where('category_id', $productToRestore->category_id)
            ->first();

        if ($activeDuplicate) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot restore. An active product with this Name, Brand, and Category already exists.'
            ]);
        }

        $productToRestore->restore();
        
        return response()->json([
            'success' => true,
            'message' => 'Product restored successfully.'
        ]);
    }
 
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120'
        ], [
            'file.required' => 'Please select a file to upload.',
            'file.mimes' => 'Invalid file type. Only .xlsx, .xls, and .csv files are allowed.',
            'file.max' => 'File is too large. Maximum size is 5MB.'
        ]);

        try {
            $import = new ProductsImport();
            Excel::import($import, $request->file('file'));
            
            $msg = "Import complete! Added {$import->createdCount} new products and updated {$import->updatedCount} existing products.";
            return back()->with('success', $msg);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Import Failed: ' . $e->getMessage());
        }
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
         
        Storage::disk('public')->delete($image->img_path);
         
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.'
        ]);
    }
}