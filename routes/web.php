<?php

use App\Models\AboutSection;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\HeroSection;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;
use App\Models\Documentation;
use App\Models\Training;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| PRA TECHNOLOGY - Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// A. ROUTE HALAMAN PUBLIK (FRONTEND)
// ==========================================

Route::get('/', function () {
    // $services hanya dipakai bagian "Bidang Keahlian" (otomatis hilang jika kosong)
    $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();

    return view('pages.home', compact('services'));
})->name('home');

Route::get('/about', fn () => view('pages.about'))->name('about');

Route::get('/services', function () {
    $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();

    return view('pages.services', compact('services'));
})->name('services');

Route::get('/projects', fn () => view('pages.projects'))->name('projects');

Route::get('/project/{slug}', function (string $slug) {
    $project = collect(config('portfolio.projects'))->firstWhere('slug', $slug);
    abort_unless($project, 404);

    return view('pages.project-detail', compact('project'));
})->name('projects.show');

Route::get('/contact', fn () => view('pages.contact'))->name('contact');

Route::get('/dokumentasi', function () {
    $docs = Documentation::query()->where('is_active', true)->latest()->get();

    return view('pages.dokumentasi', compact('docs'));
})->name('dokumentasi');

Route::get('/about', function () {
    $settings = SiteSetting::query()->get()->keyBy('key');
    $about = AboutSection::query()->where('is_active', true)->first();
    $educations = Education::query()->where('is_active', true)->orderBy('sort_order')->get();
    $experiences = Experience::query()->where('is_active', true)->orderBy('sort_order')->get();
    
    return view('pages.about', compact('settings', 'about', 'educations', 'experiences'));
})->name('about');

Route::get('/services', function () {
    $settings = SiteSetting::query()->get()->keyBy('key');
    $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();
    
    return view('pages.services', compact('settings', 'services'));
})->name('services');

Route::get('/projects', function () {
    $settings = SiteSetting::query()->get()->keyBy('key');
    $projects = Project::query()->where('is_active', true)->orderByDesc('is_featured')->orderBy('sort_order')->get();
    
    return view('pages.projects', compact('settings', 'projects'));
})->name('projects');

Route::get('/project/{project:slug}', function (Project $project) {
    abort_unless($project->is_active, 404);
    $settings = SiteSetting::query()->get()->keyBy('key');

    return view('pages.project-detail', compact('project', 'settings'));
})->name('projects.show');

Route::get('/contact', function () {
    $settings = SiteSetting::query()->get()->keyBy('key');

    return view('pages.contact', compact('settings'));
})->name('contact');

Route::get('/dokumentasi', function () {
    $settings = SiteSetting::query()->get()->keyBy('key');
    $docs = Documentation::query()->where('is_active', true)->latest()->get();

    return view('pages.dokumentasi', compact('settings', 'docs'));
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
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

// Tambahkan di dalam group admin:
Route::resource('trainings', App\Http\Controllers\Admin\TrainingController::class);
Route::resource('documentations', App\Http\Controllers\Admin\DocumentationController::class);
    
    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [DashboardController::class, 'data'])->name('stats');

    // 1. Proyek
    Route::get('projects/{project}/success', [ProjectController::class, 'success'])->name('projects.success');
    Route::resource('projects', ProjectController::class);

    // 2. Keahlian / Skills
    Route::resource('skills', SkillController::class);

    // 3. Sertifikat (Gunakan nama resource 'certificates')
    Route::resource('certificates', CertificateController::class);

    // 4. Pengalaman
    Route::resource('experiences', ExperienceController::class);

    // 5. Pendidikan (TAMBAHKAN BARIS INI)
    Route::resource('educations', App\Http\Controllers\Admin\EducationController::class);

    // 6. Pesan
    Route::resource('messages', MessageController::class);

    
});