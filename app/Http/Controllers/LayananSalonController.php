<?php

namespace App\Http\Controllers;

use App\Models\LayananSalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananSalonController extends Controller
{
    public function index()
    {
        $items = LayananSalon::latest()->get();
        return view('caffesalon.admin.tables.layanansalon.index', compact('items'));
    }

    public function create()
    {
        return view('caffesalon.admin.tables.layanansalon.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('layanan_photos', 'public');
        }

        LayananSalon::create($validatedData);

        return redirect()->route('admin.salon.layanansalon.index')->with('success', 'Layanan salon berhasil ditambahkan!');
    }

    public function show(LayananSalon $layanansalon)
    {
        return view('caffesalon.admin.tables.layanansalon.show', compact('layanansalon'));
    }

    public function edit(LayananSalon $layanansalon)
    {
        return view('caffesalon.admin.tables.layanansalon.edit', compact('layanansalon'));
    }

    public function update(Request $request, LayananSalon $layanansalon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            if ($layanansalon->photo) {
                Storage::disk('public')->delete($layanansalon->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('layanan_photos', 'public');
        }

        $layanansalon->update($validatedData);

        return redirect()->route('admin.salon.layanansalon.index')->with('success', 'Layanan salon berhasil diperbarui!');
    }

    public function destroy(LayananSalon $layanansalon)
    {
        if ($layanansalon->photo) {
            Storage::disk('public')->delete($layanansalon->photo);
        }

        $layanansalon->delete();

        return redirect()->route('admin.salon.layanansalon.index')->with('success', 'Layanan salon berhasil dihapus!');
    }
}
