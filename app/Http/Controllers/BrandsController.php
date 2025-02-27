<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;

class BrandsController extends Controller
{
    // Menampilkan daftar brands
    public function index()
    {
        $brands = Brands::all(); // Ambil semua data brands dari database
        return view('admin.brands', compact('brands')); // Kirim data brands ke view
    }

    // Menampilkan form untuk menambahkan brand baru
    public function create()
    {
        return view('admin.brands-create'); // Tampilkan form create
    }

    // Menyimpan brand baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi input
        ]);

        Brands::create($request->all()); // Simpan data ke database
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.'); // Redirect ke halaman brands
    }

    // Menampilkan form untuk mengedit brand
    public function edit($id)
    {
        $brand = Brands::findOrFail($id); // Ambil data brand berdasarkan ID
        return view('admin.brands-edit', compact('brand')); // Tampilkan form edit
    }

    // Mengupdate brand di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validasi input
        ]);

        $brand = Brands::findOrFail($id); // Ambil data brand berdasarkan ID
        $brand->update($request->all()); // Update data di database
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.'); // Redirect ke halaman brands
    }

    // Menghapus brand dari database
    public function destroy($id)
    {
        $brand = Brands::findOrFail($id); // Ambil data brand berdasarkan ID
        $brand->delete(); // Hapus data dari database
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.'); // Redirect ke halaman brands
    }
}