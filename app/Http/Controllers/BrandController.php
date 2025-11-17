<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        if (Gate::allows('owner-access')) {
            return Inertia::render('Brands/Index', [
                'brands' => Brand::all()
            ]);
        }
        abort(403, 'Access to this resource is restricted.');
    }

    public function create()
    {
        return Inertia::render('Brands/Create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'brand_id' => 'nullable',
            ]);

            if (isset($data['brand_id'])) {
                $brand = Brand::find($data['brand_id']);
                $brand->name = $data['name'];
                $brand->description = $data['description'];
                $brand->save();

                return back()->with('success', 'Brand updated successfully');
            }

            $brand = new Brand();
            $brand->name = $data['name'];
            $brand->description = $data['description'];
            $brand->save();

            return redirect()->route('brands.index')->with('success', 'Brand saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Brand $brand)
    {
        return Inertia::render('Brands/Create', [
            'brand' => $brand
        ]);
    }

    public function list()
    {
        return response()->json(Brand::all());
    }

    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            return back()->with('success', 'Brand deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
