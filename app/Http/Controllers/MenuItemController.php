<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::latest()->get();
        return view('caffesalon.admin.tables.menu.index', compact('items'));
    }

    public function create()
    {
        return view('caffesalon.admin.tables.menu.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('menu_photos', 'public');
        }

        MenuItem::create($validatedData);

        return redirect()->route('admin.caffe.menu.index')->with('success', 'Item menu berhasil ditambahkan!');
    }

    public function show(MenuItem $menu)
    {
        return view('caffesalon.admin.tables.menu.show', compact('menu'));
    }

    public function edit(MenuItem $menu)
    {
        return view('caffesalon.admin.tables.menu.edit', compact('menu'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {

            if ($menu->photo) {
                Storage::disk('public')->delete($menu->photo);
            }

            $validatedData['photo'] = $request->file('photo')->store('menu_photos', 'public');
        }

        $menu->update($validatedData);

        return redirect()->route('admin.caffe.menu.index')->with('success', 'Item menu berhasil diperbarui!');
    }

    public function destroy(MenuItem $menu)
    {
        if ($menu->photo) {
            Storage::disk('public')->delete($menu->photo);
        }

        $menu->delete();

        return redirect()->route('admin.caffe.menu.index')->with('success', 'Item menu berhasil dihapus!');
    }
}
