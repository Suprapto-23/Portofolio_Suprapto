@extends('admin.layouts.app')
@section('title', 'Detail Proyek')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold tracking-tight text-slate-900">Detail Proyek: {{ $project->title }}</h2>
        <a href="{{ route('admin.projects.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">← Kembali</a>
    </div>

    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm p-6 sm:p-8 space-y-6">
        @if($project->image)
            <div class="w-full h-64 rounded-xl overflow-hidden border border-slate-200">
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-4 border-b border-slate-100">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kategori</p>
                <p class="text-sm font-bold text-slate-800 mt-1">{{ $project->category ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Status</p>
                <p class="text-sm font-bold text-slate-800 mt-1">{{ $project->is_active ? 'Aktif' : 'Draft' }} {!! $project->is_featured ? '(<span class="text-amber-600">Unggulan</span>)' : '' !!}</p>
            </div>
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Deskripsi</p>
            <p class="text-sm text-slate-600 mt-1 leading-relaxed whitespace-pre-line">{{ $project->description ?: 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100 text-sm">
            <div>
                <span class="font-semibold text-slate-700">Demo URL:</span>
                @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="text-blue-600 hover:underline block truncate mt-0.5">{{ $project->demo_url }}</a>
                @else
                    <span class="text-slate-400 block mt-0.5">-</span>
                @endif
            </div>
            <div>
                <span class="font-semibold text-slate-700">GitHub Repository:</span>
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="text-blue-600 hover:underline block truncate mt-0.5">{{ $project->github_url }}</a>
                @else
                    <span class="text-slate-400 block mt-0.5">-</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection