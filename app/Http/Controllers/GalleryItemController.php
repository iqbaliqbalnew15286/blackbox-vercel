<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    /**
     * Menampilkan semua item galeri.
     */
    public function index()
    {
        $items = GalleryItem::latest()->get();
        return view('admin.tables.gallery.index', compact('items'));
    }

    /**
     * Menampilkan form untuk menambah gambar baru.
     */
    public function create()
    {
        return view('admin.tables.gallery.create');
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
        $imagePath = $request->file('image')->store('gallery_images', 'public');
        $validatedData['image_path'] = $imagePath;

        // Hapus 'image' dari array karena tidak ada di DB
        unset($validatedData['image']); 

        GalleryItem::create($validatedData);

        return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil ditambahkan ke galeri!');
    }

    /**
     * Menampilkan detail (tidak terlalu diperlukan untuk galeri, tapi kita buat saja)
     */
    public function show(GalleryItem $gallery) // Menggunakan Route Model Binding
    {
        return view('admin.tables.gallery.show', compact('gallery'));
    }

    /**
     * Menampilkan form untuk mengedit item galeri.
     */
    public function edit(GalleryItem $gallery)
    {
        return view('admin.tables.gallery.edit', compact('gallery'));
    }

    /**
     * Memperbarui item galeri di database.
     */
    public function update(Request $request, GalleryItem $gallery)
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
            $imagePath = $request->file('image')->store('gallery_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        // Hapus 'image' dari array
        unset($validatedData['image']);

        $gallery->update($validatedData);

        return redirect()->route('admin.gallery.index')->with('success', 'Item galeri berhasil diperbarui!');
    }

    /**
     * Menghapus item galeri dari database.
     */
    public function destroy(GalleryItem $gallery)
    {
        // Hapus file gambar dari storage
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        // Hapus data dari database
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil dihapus dari galeri!');
    }
}