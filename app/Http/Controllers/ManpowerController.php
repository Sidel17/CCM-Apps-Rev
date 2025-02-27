<?php

namespace App\Http\Controllers;

use App\Models\Manpower;
use Illuminate\Http\Request;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manpowers = Manpower::all(); // Perbaiki variabel
        return view('admin.manpower', compact('manpowers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manpower-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Manpower::create($request->all());

        return redirect()->route('manpowers.index')->with('success', 'Manpower added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $manpowers = Manpower::findOrFail($id); // Sesuaikan dengan compact
        return view('admin.manpower-edit', compact('manpowers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi input
        ]);

        $manpowers = Manpower::findOrFail($id); // Ambil data status unit
        $manpowers->update($request->all()); // Update data di database

        return redirect()->route('manpowers.index')->with('success', 'Manpower updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manpowers = Manpower::findOrFail($id); // Ambil data status unit
        $manpowers->delete(); // Hapus data dari database

        return redirect()->route('manpowers.index')->with('success', 'Manpowers deleted successfully.');
    }
}
