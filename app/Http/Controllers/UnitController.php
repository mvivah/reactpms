<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class UnitController extends Controller
{
    public function index()
    {
        if (Gate::allows('owner-access')) {
            return Inertia::render('Units/Index', [
                'units' => Unit::all()
            ]);
        }
        abort(403, 'Access to this resource is restricted.');
    }

    public function create()
    {
        return Inertia::render('Units/Create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'abbreviation' => 'required',
                'unit_id' => 'nullable',
            ]);

            if (isset($data['unit_id'])) {
                $unit = Unit::find($data['unit_id']);
                $unit->name = $data['name'];
                $unit->abbreviation = $data['abbreviation'];
                $unit->save();

                return back()->with('success', 'Unit updated successfully');
            }

            $unit = new Unit();
            $unit->name = $data['name'];
            $unit->abbreviation = $data['abbreviation'];
            $unit->save();

            return redirect()->route('units.index')->with('success', 'Unit saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Unit $unit)
    {
        return Inertia::render('Units/Create', [
            'unit' => $unit
        ]);
    }

    public function list()
    {
        return response()->json(Unit::all());
    }

    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            return back()->with('success', 'Unit deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
