<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'title',          // Nama Sertifikat
        'issuer',         // Penerbit (Contoh: Dicoding, Coursera)
        'issued_date',    // Tanggal Terbit
        'credential_url', // Link Verifikasi Sertifikat
        'file_path',      // Path ke File Gambar/PDF Sertifikat
        'description',    // Deskripsi singkat
        'is_active',      // Status tampil di halaman utama
    ];

    /**
     * Casting tipe data kolom agar sesuai.
     */
    protected $casts = [
        'issued_date' => 'date',
        'is_active' => 'boolean',
    ];
}