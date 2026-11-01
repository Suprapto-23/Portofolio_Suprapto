<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill; // Pastikan model Skill sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    public function index()
    {
        // Mengurutkan otomatis dari yang terbaru
        $skills = Skill::latest()->get();
        return view('admin.skill.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skill.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|string|in:Hard Skill,Soft Skill,Tools',
            'icon_url' => 'nullable|string', // URL ikon dari hasil pencarian pintar
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('toast', [
            'type' => 'success',
            'message' => 'Skill/Tool baru berhasil ditambahkan!'
        ]);
    }

    public function edit(Skill $skill)
    {
        return view('admin.skill.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|string|in:Hard Skill,Soft Skill,Tools',
            'icon_url' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('toast', [
            'type' => 'success',
            'message' => 'Skill/Tool berhasil diperbarui!'
        ]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('toast', [
            'type' => 'success',
            'message' => 'Skill/Tool berhasil dihapus!'
        ]);
    }
}