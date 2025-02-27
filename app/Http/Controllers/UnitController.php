<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Brands;
use App\Models\UnitModels;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::with(['brand', 'unitModel'])->get();
        return view('admin.unit', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brands::all();
        return view('admin.unit-create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codeunit' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'unitmodel_id' => 'required|exists:unitmodels,id'
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')->with('success', 'Unit added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $brands = Brands::all();
        $unitModels = UnitModels::where('brand_id', $unit->brand_id)->get();
        return view('admin.unit-edit', compact('unit', 'brands', 'unitModels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'codeunit' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'unitmodel_id' => 'required|exists:unitmodels,id'
        ]);

        $unit->update($request->all());

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }

    /**
     * Fetch unit models dynamically based on selected brand.
     */
    public function getUnitModels($brand_id)
    {
        $unitModels = UnitModels::where('brand_id', $brand_id)->get();
        return response()->json($unitModels);
    }
}
