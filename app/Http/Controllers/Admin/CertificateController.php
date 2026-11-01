<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderByDesc('issued_date')->get();
        return view('admin.certificate.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificate.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'credential_url' => 'nullable|url',
            'file_path' => 'nullable|mimes:jpeg,png,jpg,webp,pdf|max:5120', // Mendukung Gambar & PDF (Max 5MB)
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('certificates', 'public');
        }

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('toast', [
            'type' => 'success',
            'message' => 'Sertifikat berhasil ditambahkan!'
        ]);
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificate.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'credential_url' => 'nullable|url',
            'file_path' => 'nullable|mimes:jpeg,png,jpg,webp,pdf|max:5120',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            if ($certificate->file_path) {
                Storage::disk('public')->delete($certificate->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('certificates', 'public');
        }

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('toast', [
            'type' => 'success',
            'message' => 'Sertifikat berhasil diperbarui!'
        ]);
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }
        
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('toast', [
            'type' => 'success',
            'message' => 'Sertifikat berhasil dihapus!'
        ]);
    }
}