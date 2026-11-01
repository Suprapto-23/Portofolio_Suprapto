<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Training;
use App\Models\Documentation;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'projects'     => Project::latest()->take(3)->get(),
            'skills'       => Skill::orderBy('sort_order')->get(), // atau all()
            'certificates' => Certificate::latest()->take(6)->get(),
            'experiences'  => Experience::orderBy('start_date', 'desc')->get(),
            'educations'   => Education::orderBy('start_year', 'desc')->get(),
            'trainings'    => Training::latest()->get(),
            'documentations' => Documentation::where('is_active', true)->latest()->take(6)->get(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'educations' => Education::orderBy('start_year', 'desc')->get(),
            'experiences' => Experience::orderBy('start_date', 'desc')->get(),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'skills' => Skill::all(),
        ]);
    }

    public function projects()
    {
        return view('pages.projects', [
            'projects' => Project::latest()->paginate(6),
        ]);
    }

    public function dokumentasi()
    {
        return view('pages.dokumentasi', [
            'documentations' => Documentation::where('is_active', true)->latest()->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}