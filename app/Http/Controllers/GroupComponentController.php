<?php

namespace App\Http\Controllers;

use App\Models\GroupCompnent;
use Illuminate\Http\Request;

class GroupComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupcomponents = GroupCompnent::all();
        return view('admin.groupcomponent', compact('groupcomponents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.groupcomponent-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        GroupCompnent::create($request->all());

        return redirect()->route('groupcomponent.index')->with('success', 'Group Component added successfully!');
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
        $groupcomponents = GroupCompnent::findOrFail($id); // Sesuaikan dengan compact
        return view('admin.groupcomponent-edit', compact('groupcomponents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi input
        ]);

        $groupcomponents = GroupCompnent::findOrFail($id); // Ambil data status unit
        $groupcomponents->update($request->all()); // Update data di database

        return redirect()->route('groupcomponent.index')->with('success', 'Group Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $groupcomponents = GroupCompnent::findOrFail($id); // Ambil data status unit
        $groupcomponents->delete(); // Hapus data dari database

        return redirect()->route('groupcomponent.index')->with('success', 'Group Component deleted successfully.');
    }
}
