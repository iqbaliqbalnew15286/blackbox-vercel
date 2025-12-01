<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Menampilkan daftar semua testimoni.
     */
    public function index()
    {
        $items = Testimonial::latest()->get();
        return view('caffesalon.admin.tables.testimonial.index', compact('items'));
    }

    /**
     * Menampilkan form untuk membuat testimoni baru.
     */
    public function create()
    {
        return view('caffesalon.admin.tables.testimonial.create');
    }

    /**
     * Menyimpan testimoni baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quote' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'role' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
        ], [
            'name.required' => 'Nama harus diisi.',
            'quote.required' => 'Kutipan testimoni harus diisi.',
            'rating.integer' => 'Rating harus berupa angka antara 1 dan 5.',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('testimonial_avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        }

        // Handle checkbox 'is_visible'
        $validatedData['is_visible'] = $request->has('is_visible');

        Testimonial::create($validatedData);

        return redirect()->route('admin.caffe.testimonial.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu testimoni (opsional, bisa diskip jika tidak perlu).
     */
    public function show(Testimonial $testimonial)
    {
        return view('caffesalon.admin.tables.testimonial.show', compact('testimonial'));
    }

    /**
     * Menampilkan form untuk mengedit testimoni.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('caffesalon.admin.tables.testimonial.edit', compact('testimonial'));
    }

    /**
     * Memperbarui testimoni di database.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quote' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'role' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            // Simpan avatar baru
            $avatarPath = $request->file('avatar')->store('testimonial_avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        }

        // Handle checkbox 'is_visible'
        $validatedData['is_visible'] = $request->has('is_visible');

        $testimonial->update($validatedData);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Menghapus testimoni dari database.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Hapus avatar terkait saat testimoni dihapus
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.caffe.testimonial.index')->with('success', 'Testimoni berhasil dihapus!');
    }
}
