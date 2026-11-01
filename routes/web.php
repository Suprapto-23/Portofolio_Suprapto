<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentationController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Documentation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PRA TECHNOLOGY - Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// A. ROUTE HALAMAN PUBLIK (FRONTEND)
// ------------------------------------------
// Semua konten halaman publik dibaca dari config/portfolio.php dan
// config/portfolio_site.php, jadi tidak ada query database di sini
// (kecuali "Catatan dan arsip" di /dokumentasi, yang opsional).
// Setiap route hanya didefinisikan SATU kali.
// ==========================================

Route::view('/', 'pages.home')->name('home');

Route::view('/about', 'pages.about')->name('about');

Route::view('/services', 'pages.services')->name('services');

Route::view('/projects', 'pages.projects')->name('projects');

Route::get('/project/{slug}', function (string $slug) {
    $project = collect(config('portfolio.projects'))->firstWhere('slug', $slug);
    abort_unless($project, 404);

    return view('pages.project-detail', compact('project'));
})->name('projects.show');

Route::view('/contact', 'pages.contact')->name('contact');

Route::get('/dokumentasi', function () {
    // Catatan dari database bersifat opsional: bila tabel/model belum siap,
    // halaman tetap tampil memakai foto dari config (tanpa error).
    $docs = rescue(
        fn () => Documentation::query()->where('is_active', true)->latest()->get(),
        collect(),
        false
    );

    return view('pages.dokumentasi', compact('docs'));
})->name('dokumentasi');


// ==========================================
// B. ROUTE AUTENTIKASI ADMIN
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


// ==========================================
// C. ROUTE PANEL ADMIN (CRUD LENGKAP)
// ------------------------------------------
// Belum dikerjakan: isi tidak diubah, hanya dirapikan.
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [DashboardController::class, 'data'])->name('stats');

    // 1. Proyek
    Route::get('projects/{project}/success', [ProjectController::class, 'success'])->name('projects.success');
    Route::resource('projects', ProjectController::class);

    // 2. Keahlian / Skills
    Route::resource('skills', SkillController::class);

    // 3. Sertifikat
    Route::resource('certificates', CertificateController::class);

    // 4. Pengalaman
    Route::resource('experiences', ExperienceController::class);

    // 5. Pendidikan
    Route::resource('educations', EducationController::class);

    // 6. Pelatihan
    Route::resource('trainings', TrainingController::class);

    // 7. Dokumentasi
    Route::resource('documentations', DocumentationController::class);

    // 8. Pesan
    Route::resource('messages', MessageController::class);
});