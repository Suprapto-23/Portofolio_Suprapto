<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    public function index()
    {
        $documentations = Documentation::latest()->get();
        return view('admin.documentation.index', compact('documentations'));
    }

    public function create()
    {
        return view('admin.documentation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Maks 5MB
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('documentations', 'public');
        }

        Documentation::create($validated);

        return redirect()->route('admin.documentations.index')->with('toast', [
            'type' => 'success',
            'message' => 'Dokumentasi berhasil ditambahkan!'
        ]);
    }

    public function edit(Documentation $documentation)
    {
        return view('admin.documentation.edit', compact('documentation'));
    }

    public function update(Request $request, Documentation $documentation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image_path')) {
            if ($documentation->image_path) {
                Storage::disk('public')->delete($documentation->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('documentations', 'public');
        }

        $documentation->update($validated);

        return redirect()->route('admin.documentations.index')->with('toast', [
            'type' => 'success',
            'message' => 'Dokumentasi berhasil diperbarui!'
        ]);
    }

    public function destroy(Documentation $documentation)
    {
        if ($documentation->image_path) {
            Storage::disk('public')->delete($documentation->image_path);
        }

        $documentation->delete();

        return redirect()->route('admin.documentations.index')->with('toast', [
            'type' => 'success',
            'message' => 'Dokumentasi berhasil dihapus!'
        ]);
    }
}