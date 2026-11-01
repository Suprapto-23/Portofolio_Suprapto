<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => $this->counts(),
            'projects' => DB::table('projects')->orderByDesc('created_at')->limit(5)->get(),
            'messages' => DB::table('contact_messages')->orderByDesc('created_at')->limit(5)->get(),
        ]);
    }

    public function data()
    {
        return response()->json($this->counts());
    }

    private function counts(): array
    {
        return [
            'projects' => DB::table('projects')->count(),
            'skills' => DB::table('skills')->count(),
            'certifications' => DB::table('certifications')->count(),
            'experiences' => DB::table('experiences')->count(),
            'unread' => DB::table('contact_messages')->where('status', 'unread')->count(),
        ];
    }
}