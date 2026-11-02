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
// config/portfolio_site.php, jadi tidak ada query database di sini.
// Setiap route hanya didefinisikan SATU kali.
// ==========================================

Route::view('/', 'pages.home')->name('home');

Route::view('/about', 'pages.about')->name('about');

Route::view('/skills', 'pages.skills')->name('skills');

// Tautan lama /services tetap hidup dan diarahkan ke /skills
Route::redirect('/services', '/skills', 301);

Route::view('/projects', 'pages.projects')->name('projects');

Route::get('/project/{slug}', function (string $slug) {
    $project = collect(config('portfolio.projects'))->firstWhere('slug', $slug);
    abort_unless($project, 404);

    return view('pages.project-detail', compact('project'));
})->name('projects.show');

Route::view('/contact', 'pages.contact')->name('contact');

// Halaman Dokumentasi digabung ke halaman Proyek (foto sudah ada di
// halaman detail proyek, Profil, dan Skill). Tautan lama tetap hidup.
Route::redirect('/dokumentasi', '/projects')->name('dokumentasi');


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

    // 6. Dokumentasi
    Route::resource('documentations', DocumentationController::class);

    // 7. Pelatihan dan Pesan
    // Controller-nya belum ada di repo. Route baru didaftarkan jika filenya
    // sudah dibuat, supaya aplikasi tidak error saat belum tersedia.
    foreach (['trainings' => TrainingController::class, 'messages' => MessageController::class] as $name => $controller) {
        if (class_exists($controller)) {
            Route::resource($name, $controller);
        }
    }
});