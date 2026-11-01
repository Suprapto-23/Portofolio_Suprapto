<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('documentations', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul Dokumentasi
        $table->string('category')->nullable(); // Kategori (Misal: Kegiatan, Sertifikasi, Event, dll)
        $table->string('image_path'); // File Gambar / Foto Utama
        $table->text('description')->nullable(); // Deskripsi Singkat
        $table->boolean('is_active')->default(true); // Status Tampil
        $table->integer('sort_order')->default(0); // Urutan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};