<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ourteams = OurTeam::all();
        return view('caffesalon.admin.tables.ourteam.index', compact('ourteams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caffesalon.admin.tables.ourteam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('ourteam', 'public');
        }

        OurTeam::create($data);

        return redirect()
            ->route('admin.caffe.ourteam.index')
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ourteam = OurTeam::findOrFail($id);
        return view('caffesalon.admin.tables.ourteam.show', compact('ourteam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ourteam = OurTeam::findOrFail($id);
        return view('caffesalon.admin.tables.ourteam.edit', compact('ourteam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255',
        ]);

        $ourteam = OurTeam::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('photo')) {

            if ($ourteam->photo && Storage::disk('public')->exists($ourteam->photo)) {
                Storage::disk('public')->delete($ourteam->photo);
            }

            $data['photo'] = $request->file('photo')->store('ourteam', 'public');
        }

        $ourteam->update($data);

        return redirect()
            ->route('admin.caffe.ourteam.index')
            ->with('success', 'Anggota tim berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ourteam = OurTeam::findOrFail($id);

        if ($ourteam->photo && Storage::disk('public')->exists($ourteam->photo)) {
            Storage::disk('public')->delete($ourteam->photo);
        }

        $ourteam->delete();

        return redirect()
            ->route('admin.caffe.ourteam.index')
            ->with('success', 'Anggota tim berhasil dihapus.');
    }

    /**
     * Upload photo via AJAX (FilePond)
     */
    public function uploadPhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ourteam = OurTeam::findOrFail($id);

        if ($ourteam->photo && Storage::disk('public')->exists($ourteam->photo)) {
            Storage::disk('public')->delete($ourteam->photo);
        }

        $path = $request->file('photo')->store('ourteam', 'public');

        $ourteam->update(['photo' => $path]);

        return response()->json([
            'success' => true,
            'photo_url' => asset('storage/' . $path),
        ]);
    }
}
