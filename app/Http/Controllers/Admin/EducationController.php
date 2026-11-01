<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::latest()->get();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:100',
            'major' => 'required|string|max:150',
            'gpa' => 'required|string|max:20',
            'period' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_position' => 'required|in:left,right',
            'description' => 'nullable|string',
            'documentations.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Unggah foto profil utama
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('educations/profile', 'public');
        }

        // Unggah dokumentasi galeri multiple
        $docs = [];
        if ($request->hasFile('documentations')) {
            foreach ($request->file('documentations') as $file) {
                $docs[] = $file->store('educations/gallery', 'public');
            }
        }
        $validated['documentations'] = !empty($docs) ? json_encode($docs) : null;

        Education::create($validated);

        return redirect()->route('admin.educations.index')->with('toast', [
            'type' => 'success',
            'message' => 'Data pendidikan berhasil ditambahkan!'
        ]);
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:100',
            'major' => 'required|string|max:150',
            'gpa' => 'required|string|max:20',
            'period' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_position' => 'required|in:left,right',
            'description' => 'nullable|string',
            'documentations.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Ganti foto profil jika ada unggahan baru
        if ($request->hasFile('photo')) {
            if ($education->photo) {
                Storage::disk('public')->delete($education->photo);
            }
            $validated['photo'] = $request->file('photo')->store('educations/profile', 'public');
        }

        // Tangani dokumentasi galeri tambahan
        $docs = json_decode($education->documentations, true) ?? [];
        if ($request->hasFile('documentations')) {
            foreach ($request->file('documentations') as $file) {
                $docs[] = $file->store('educations/gallery', 'public');
            }
        }
        $validated['documentations'] = !empty($docs) ? json_encode(array_values($docs)) : null;

        $education->update($validated);

        return redirect()->route('admin.educations.index')->with('toast', [
            'type' => 'success',
            'message' => 'Data pendidikan berhasil diperbarui!'
        ]);
    }

    public function destroy(Education $education)
    {
        if ($education->photo) {
            Storage::disk('public')->delete($education->photo);
        }
        if ($education->documentations) {
            foreach (json_decode($education->documentations, true) as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $education->delete();

        return redirect()->route('admin.educations.index')->with('toast', [
            'type' => 'success',
            'message' => 'Data pendidikan berhasil dihapus!'
        ]);
    }
}