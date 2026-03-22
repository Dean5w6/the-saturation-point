<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select('*');
            return DataTables::of($categories)
                ->addColumn('image', function ($row) {
                    if ($row->img_path) {
                        return '<img src="'.Storage::url($row->img_path).'" style="width: 50px; height: 50px; object-fit: cover;" class="rounded border">';
                    }
                    return '<div class="rounded bg-light border d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i class="fas fa-image text-muted"></i></div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex gap-1 justify-content-center">
                                <a href="'.route('admin.categories.edit', $row->id).'" class="btn btn-primary btn-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 2px; height: 31px;">EDIT</a>
                                <form action="'.route('admin.categories.destroy', $row->id).'" method="POST" class="m-0">
                                    '.csrf_field().method_field('DELETE').'
                                    <button type="submit" class="btn btn-danger btn-sm text-nowrap d-flex align-items-center justify-content-center" style="border-radius: 2px; height: 31px;" onclick="return confirm(\'Delete this category?\')">DELETE</button>
                                </form>
                            </div>';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'img_path' => 'nullable|image|max:2048'
        ]);

        $data = ['name' => $request->name, 'description' => null];

        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('categories', 'public');
        }

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'img_path' => 'nullable|image|max:2048'
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('img_path')) {
            if ($category->img_path) { Storage::disk('public')->delete($category->img_path); }
            $data['img_path'] = $request->file('img_path')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        if ($category->img_path) { Storage::disk('public')->delete($category->img_path); }
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }
}