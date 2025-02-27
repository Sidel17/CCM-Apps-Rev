<?php

namespace App\Http\Controllers;

use App\Models\UnitModels;
use App\Models\Brands;
use Illuminate\Http\Request;

class UnitModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitModels = UnitModels::with('brand')->get();
        return view('admin.unitmodels', compact('unitModels')); // Sesuaikan nama view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brands::all();
        return view('admin.unitmodels-create', compact('brands')); // Sesuaikan nama view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        UnitModels::create($request->all());

        return redirect()->route('unitmodels.index')->with('success', 'Unit model created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitModels $unitModel)
    {
        return view('admin.unitmodels-show', compact('unitModel')); // Sesuaikan nama view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unitmodel = UnitModels::findOrFail($id); // Ambil data unit model berdasarkan ID
        $brands = Brands::all(); // Ambil semua data brand untuk dropdown

        return view('admin.unitmodels-edit', compact('unitmodel', 'brands'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        // Cari unit model berdasarkan ID
        $unitModel = UnitModels::findOrFail($id);

        // Update data
        $unitModel->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
        ]);

        return redirect()->route('unitmodels.index')->with('success', 'Unit Model updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unitModel = UnitModels::findOrFail($id);
        $unitModel->delete();

        return redirect()->route('unitmodels.index')->with('success', 'Unit Model deleted successfully!');
    }

}