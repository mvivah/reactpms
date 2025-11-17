<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class SupplierController extends Controller
{
    public function index()
    {
        if (Gate::allows('owner-access')) {
            return Inertia::render('Suppliers/Index', [
                'suppliers' => Supplier::all()
            ]);
        }
        abort(403, 'Access to this resource is restricted.');
    }

    public function create()
    {
        return Inertia::render('Suppliers/Create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'nullable',
                'supplier_id' => 'nullable',
            ]);

            if (isset($data['supplier_id'])) {
                $supplier = Supplier::find($data['supplier_id']);
                $supplier->fill($data);
                $supplier->save();

                return back()->with('success', 'Supplier updated successfully');
            }

            Supplier::create($data);

            return redirect()->route('suppliers.index')->with('success', 'Supplier saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Supplier $supplier)
    {
        return Inertia::render('Suppliers/Create', [
            'supplier' => $supplier
        ]);
    }

    public function list()
    {
        return response()->json(Supplier::all());
    }

    public function updateActiveStatus(Request $request)
    {
        try {
            $supplier = Supplier::find($request->supplier_id);
            $supplier->status = $request->status;
            $supplier->save();

            return back()->with('success', 'Supplier status updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return back()->with('success', 'Supplier deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
