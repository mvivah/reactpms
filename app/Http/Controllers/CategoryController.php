<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        if (Gate::allows('owner-access')) {
            return Inertia::render('Categories/Index', [
                'categories' => Category::all()
            ]);
        }
        abort(403, 'Access to this resource is restricted.');
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'category_id' => 'nullable',
            ]);

            if (isset($data['category_id'])) {
                $category = Category::find($data['category_id']);
                $category->name = $data['name'];
                $category->description = $data['description'];
                $category->save();

                return back()->with('success', 'Category updated successfully');
            }

            $category = new Category();
            $category->name = $data['name'];
            $category->description = $data['description'];
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        return Inertia::render('Categories/Create', [
            'category' => $category
        ]);
    }

    public function list()
    {
        return response()->json(Category::all());
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return back()->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
