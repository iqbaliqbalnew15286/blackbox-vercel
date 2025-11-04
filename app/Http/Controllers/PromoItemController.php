<?php

namespace App\Http\Controllers;

use App\Models\PromoItem; // Ganti ke model PromoItem
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // Diperlukan untuk validasi unique saat update

class PromoItemController extends Controller
{
    /**
     * Menampilkan semua item promo.
     */
    public function index()
    {
        $items = PromoItem::latest()->get();
        // Arahkan ke view promo index
        return view('admin.tables.promo.index', compact('items'));
    }

    /**
     * Menampilkan form untuk membuat promo baru.
     */
    public function create()
    {
        return view('admin.tables.promo.create');
    }

    /**
     * Menyimpan promo baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'code' => 'nullable|string|unique:promo_items|max:50',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'name.required' => 'Nama promo harus diisi.',
            'code.unique' => 'Kode promo ini sudah digunakan.',
            'discount_type.required' => 'Tipe diskon harus dipilih.',
            'discount_value.required' => 'Nilai diskon harus diisi.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'end_date.required' => 'Tanggal berakhir harus diisi.',
            'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
        ]);

        // Logika untuk file upload (menggunakan 'image' sbg ganti 'photo')
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('promo_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Handle checkbox 'is_active'
        // Jika checkbox tidak dicentang, 'is_active' tidak akan ada di request
        $validatedData['is_active'] = $request->has('is_active');

        PromoItem::create($validatedData);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu promo.
     */
    public function show(PromoItem $promo) // Gunakan Route Model Binding
    {
        return view('admin.tables.promo.show', compact('promo'));
    }

    /**
     * Menampilkan form untuk mengedit promo.
     */
    public function edit(PromoItem $promo)
    {
        return view('admin.tables.promo.edit', compact('promo'));
    }

    /**
     * Memperbarui promo di database.
     */
    public function update(Request $request, PromoItem $promo)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Rule unique harus mengabaikan ID promo saat ini
            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('promo_items')->ignore($promo->id),
            ],
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Logika untuk file upload (update)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($promo->image) {
                Storage::disk('public')->delete($promo->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('promo_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Handle checkbox 'is_active'
        $validatedData['is_active'] = $request->has('is_active');

        $promo->update($validatedData);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    /**
     * Menghapus promo dari database.
     */
    public function destroy(PromoItem $promo)
    {
        // Hapus gambar terkait saat promo dihapus
        if ($promo->image) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus!');
    }
}