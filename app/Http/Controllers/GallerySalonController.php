<?php

namespace App\Http\Controllers;

use App\Models\GallerySalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GallerySalonController extends Controller
{
    /**
     * Menampilkan semua item galeri salon.
     */
    public function index()
    {
        $items = GallerySalon::latest()->get();
        return view('caffesalon.admin.tables.gallerysalon.index', compact('items'));
    }

    /**
     * Menampilkan form untuk menambah gambar baru.
     */
    public function create()
    {
        return view('caffesalon.admin.tables.gallerysalon.create');
    }

    /**
     * Menyimpan gambar baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Gambar 'wajib' ada saat membuat item galeri baru
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Nama gambar harus diisi.',
            'image.required' => 'File gambar harus di-upload.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        // Simpan gambar
        $imagePath = $request->file('image')->store('gallery_salon_images', 'public');
        $validatedData['image_path'] = $imagePath;

        // Hapus 'image' dari array karena tidak ada di DB
        unset($validatedData['image']);

        GallerySalon::create($validatedData);

        return redirect()->route('admin.salon.gallery.index')->with('success', 'Gambar berhasil ditambahkan ke galeri salon!');
    }

    /**
     * Menampilkan detail (tidak terlalu diperlukan untuk galeri, tapi kita buat saja)
     */
    public function show(GallerySalon $gallery) // Menggunakan Route Model Binding
    {
        return view('caffesalon.admin.tables.gallerysalon.show', compact('gallery'));
    }

    /**
     * Menampilkan form untuk mengedit item galeri.
     */
    public function edit(GallerySalon $gallery)
    {
        return view('caffesalon.admin.tables.gallerysalon.edit', compact('gallery'));
    }

    /**
     * Memperbarui item galeri di database.
     */
    public function update(Request $request, GallerySalon $gallery)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Gambar 'tidak wajib' saat update (opsional)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Cek jika ada file gambar baru
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            // 2. Simpan gambar baru
            $imagePath = $request->file('image')->store('gallery_salon_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        // Hapus 'image' dari array
        unset($validatedData['image']);

        $gallery->update($validatedData);

        return redirect()->route('admin.salon.gallery.index')->with('success', 'Item galeri salon berhasil diperbarui!');
    }

    /**
     * Menghapus item galeri dari database.
     */
    public function destroy(GallerySalon $gallery)
    {
        // Hapus file gambar dari storage
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        // Hapus data dari database
        $gallery->delete();

        return redirect()->route('admin.salon.gallery.index')->with('success', 'Gambar berhasil dihapus dari galeri salon!');
    }
}
