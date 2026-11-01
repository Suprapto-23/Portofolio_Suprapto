<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('educations', function (Blueprint $table) {
        $table->id();
        $table->string('institution'); // Nama Kampus / Sekolah
        $table->string('degree'); // Gelar / Jenjang (Misal: S1 - Teknik Informatika)
        $table->string('major'); // Jurusan
        $table->string('gpa'); // IPK (Misal: 3.85 / 4.00)
        $table->string('period'); // Periode (Misal: 2020 - 2024)
        $table->string('photo')->nullable(); // Foto Profil Mahasiswa
        $table->string('photo_position')->default('right'); // Posisi Foto: 'left' atau 'right'
        $table->text('description')->nullable(); // Deskripsi Detail Selama Kuliah
        $table->json('documentations')->nullable(); // Galeri Dokumentasi Mahasiswa (Multiple Images)
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
