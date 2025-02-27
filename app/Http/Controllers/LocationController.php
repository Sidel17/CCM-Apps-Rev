<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.location', compact('locations'));
    }

    public function create()
    {
        return view('admin.location-create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Location::create($request->all());
        return redirect()->route('locations.index')->with('success', 'Location added successfully!');
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.location-edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi input
        ]);

        $brand = Location::findOrFail($id); // Ambil data brand berdasarkan ID
        $brand->update($request->all()); // Update data di database
        return redirect()->route('locations.index')->with('success', 'Location updated successfully.'); // Redirect ke halaman brands
    }

    public function destroy($id)
    {
        $brand = Location::findOrFail($id); // Ambil data brand berdasarkan ID
        $brand->delete(); // Hapus data dari database
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.'); // Redirect ke halaman brands
    }
}

