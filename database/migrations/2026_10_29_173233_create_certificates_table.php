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
    Schema::create('certificates', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Nama Sertifikat
        $table->string('issuer'); // Penerbit (Contoh: Dicoding, Coursera)
        $table->date('issued_date'); // Tanggal Terbit
        $table->string('credential_url')->nullable(); // Link Verifikasi
        $table->string('file_path')->nullable(); // File Gambar/PDF
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
