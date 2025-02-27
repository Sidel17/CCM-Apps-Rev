<?php

namespace App\Http\Controllers;

use App\Models\ComponentDetail;
use App\Models\GroupCompnent;
use Illuminate\Http\Request;

class ComponentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $componentdetail = ComponentDetail::with('groupcomponent')->get();
        return view('admin.componentdetail', compact('componentdetail')); // Sesuaikan nama view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupcomponent = GroupCompnent::all();
        return view('admin.componentdetail-create', compact('groupcomponent')); // Sesuaikan nama view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'groupcomponent_id' => 'required|exists:groupcomponent,id',
            'name' => 'required|string|max:255',
        ]);

        ComponentDetail::create($request->all());

        return redirect()->route('componentdetail.index')->with('success', 'Component created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $componentdetail = ComponentDetail::findOrFail($id); // Ambil data unit model berdasarkan ID
        $groupcomponent = GroupCompnent::all(); // Ambil semua data brand untuk dropdown

        return view('admin.componentdetail-edit', compact('componentdetail', 'groupcomponent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'groupcomponent_id' => 'required|exists:groupcomponent,id',
            'name' => 'required|string|max:255',
        ]);

        // Cari unit model berdasarkan ID
        $componentdetail = ComponentDetail::findOrFail($id);

        // Update data
        $componentdetail->update([
            'groupcomponent_id' => $request->groupcomponent_id,
            'name' => $request->name,
        ]);

        return redirect()->route('componentdetail.index')->with('success', 'Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $componentdetail = ComponentDetail::findOrFail($id);
        $componentdetail->delete();

        return redirect()->route('componentdetail.index')->with('success', 'Component deleted successfully!');
    }
}
