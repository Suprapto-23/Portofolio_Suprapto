<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar seluruh proyek (otomatis diurutkan dari yang terbaru).
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Menampilkan form tambah proyek baru.
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Menyimpan data proyek baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'documentation' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'technologies' => 'nullable|array',
            'soft_skills' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');
        
        // Encode array tools & soft skills menjadi JSON string
        $validated['technologies'] = isset($validated['technologies']) ? json_encode(array_values($validated['technologies'])) : null;
        $validated['soft_skills'] = isset($validated['soft_skills']) ? json_encode(array_values($validated['soft_skills'])) : null;

        // Proses unggah gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create($validated);

        // Alihkan ke halaman perayaan sukses
        return redirect()->route('admin.projects.success', $project->id);
    }

    /**
     * Menampilkan detail proyek tertentu di panel admin.
     */
    public function show(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }

    /**
     * Menampilkan form edit proyek.
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', compact('project'));
    }

    /**
     * Memperbarui data proyek yang ada di database.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'documentation' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'technologies' => 'nullable|array',
            'soft_skills' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        // Encode array tools & soft skills menjadi JSON string
        $validated['technologies'] = isset($validated['technologies']) ? json_encode(array_values($validated['technologies'])) : null;
        $validated['soft_skills'] = isset($validated['soft_skills']) ? json_encode(array_values($validated['soft_skills'])) : null;

        // Ganti gambar jika berkas baru diunggah
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('toast', [
            'type' => 'success',
            'message' => 'Proyek berhasil diperbarui!'
        ]);
    }

    /**
     * Menghapus data proyek beserta gambar thumbnail dari storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')->with('toast', [
            'type' => 'success',
            'message' => 'Proyek berhasil dihapus!'
        ]);
    }

    /**
     * Menampilkan halaman perayaan sukses setelah proyek baru diposting.
     */
    public function success(Project $project)
    {
        return view('admin.project.success', compact('project'));
    }
}