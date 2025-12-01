<?php

namespace App\Http\Controllers;

use App\Models\TestimonialSalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialSalonController extends Controller
{
    public function index()
    {
        $items = TestimonialSalon::latest()->get();
        return view('caffesalon.admin.tables.testimonialsalon.index', compact('items'));
    }

    public function create()
    {
        return view('caffesalon.admin.tables.testimonialsalon.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($request->hasFile('avatar')) {
            $validatedData['avatar'] = $request->file('avatar')->store('testimonial_avatars', 'public');
        }

        TestimonialSalon::create($validatedData);

        return redirect()->route('admin.salon.testimonialsalon.index')->with('success', 'Testimoni salon berhasil ditambahkan!');
    }

    public function show(TestimonialSalon $testimonialsalon)
    {
        return view('caffesalon.admin.tables.testimonialsalon.show', compact('testimonialsalon'));
    }

    public function edit(TestimonialSalon $testimonialsalon)
    {
        return view('caffesalon.admin.tables.testimonialsalon.edit', compact('testimonialsalon'));
    }

    public function update(Request $request, TestimonialSalon $testimonialsalon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($request->hasFile('avatar')) {
            if ($testimonialsalon->avatar) {
                Storage::disk('public')->delete($testimonialsalon->avatar);
            }
            $validatedData['avatar'] = $request->file('avatar')->store('testimonial_avatars', 'public');
        }

        $testimonialsalon->update($validatedData);

        return redirect()->route('admin.salon.testimonialsalon.index')->with('success', 'Testimoni salon berhasil diperbarui!');
    }

    public function destroy(TestimonialSalon $testimonialsalon)
    {
        if ($testimonialsalon->avatar) {
            Storage::disk('public')->delete($testimonialsalon->avatar);
        }

        $testimonialsalon->delete();

        return redirect()->route('admin.salon.testimonialsalon.index')->with('success', 'Testimoni salon berhasil dihapus!');
    }
}
