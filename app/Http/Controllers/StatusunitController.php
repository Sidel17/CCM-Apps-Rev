<?php

namespace App\Http\Controllers;

use App\Models\Statusunit;
use Illuminate\Http\Request;

class StatusunitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statusunits = Statusunit::all(); // Perbaiki variabel
        return view('admin.statusunit', compact('statusunits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statusunit-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Statusunit::create($request->all());

        return redirect()->route('statusunits.index')->with('success', 'Status Unit added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $statusunit = Statusunit::findOrFail($id); // Sesuaikan dengan compact
        return view('admin.statusunit-edit', compact('statusunit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi input
        ]);

        $statusunit = Statusunit::findOrFail($id); // Ambil data status unit
        $statusunit->update($request->all()); // Update data di database

        return redirect()->route('statusunits.index')->with('success', 'Status Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $statusunit = Statusunit::findOrFail($id); // Ambil data status unit
        $statusunit->delete(); // Hapus data dari database

        return redirect()->route('statusunits.index')->with('success', 'Status Unit deleted successfully.');
    }
}
