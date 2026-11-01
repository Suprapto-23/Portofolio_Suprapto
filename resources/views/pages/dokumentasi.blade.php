@extends('layouts.app')

@section('content')
@php
    $P = config('portfolio');

    // Kumpulkan foto dari data yang sudah ada: galeri proyek, foto pengalaman, foto kegiatan.
    // Mengganti/menambah foto cukup lewat config/portfolio.php. File yang tidak ada otomatis dilewati.
    $items = collect();
    $push = function (string $group, string $label, mixed $rows) use (&$items) {
        foreach (\App\Support\Img::existing($rows) as $row) {
            $items->push(['group' => $group, 'label' => $label, 'src' => asset($row[0]), 'caption' => $row[1] ?? '']);
        }
    };
    foreach ($P['projects'] ?? [] as $p)    { $push('Proyek', $p['title'] ?? '', $p['gallery'] ?? []); }
    foreach ($P['experiences'] ?? [] as $e) { $push('Pengalaman', $e['role'] ?? '', $e['photos'] ?? []); }
    foreach ($P['activities'] ?? [] as $a)  { $push('Kegiatan', $a[0] ?? ($a['title'] ?? ''), $a[4] ?? ($a['photos'] ?? [])); }

    $groups = $items->pluck('group')->unique()->values();
    $docs   = $docs ?? [];
@endphp

<style>
    #docModal::backdrop { background: rgba(11, 27, 58, .72); backdrop-filter: blur(3px); }
</style>

<!-- HERO -->
<section class="relative overflow-hidden bg-[#0B1B3A] pb-20 pt-24 lg:pb-24 lg:pt-32">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
    <div class="relative z-10 mx-auto max-w-[1180px] px-6">
        <div class="max-w-[720px]">
            <h1 class="mb-4 text-[36px] font-extrabold leading-tight text-white md:text-[48px]">Dokumentasi</h1>
            <p class="text-[16px] leading-relaxed text-gray-300">
                Tangkapan layar sistem dan foto kegiatan dari proyek, pengalaman, dan organisasi. Klik gambar untuk memperbesar.
            </p>
        </div>
    </div>
</section>

<!-- GALERI -->
<section class="bg-[#FAFCFF] py-16">
    <div class="mx-auto max-w-[1180px] px-6">

        @if($items->isNotEmpty())
            <div class="mb-8 flex flex-wrap items-center gap-2" role="group" aria-label="Saring dokumentasi">
                <button type="button" data-filter="all" class="doc-chip rounded-full border border-[#1677FF] bg-[#1677FF] px-4 py-1.5 text-[13px] font-semibold text-white">Semua ({{ $items->count() }})</button>
                @foreach($groups as $g)
                    <button type="button" data-filter="{{ $g }}" class="doc-chip rounded-full border border-[#DCE7F5] bg-white px-4 py-1.5 text-[13px] font-semibold text-[#0B1B3A] hover:border-[#1677FF]">{{ $g }} ({{ $items->where('group', $g)->count() }})</button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($items as $it)
                    <figure data-doc data-group="{{ $it['group'] }}" class="overflow-hidden rounded-[20px] border border-[#DCE7F5] bg-white shadow-sm transition duration-300 hover:border-[#1677FF]/40">
                        <button type="button" data-open data-src="{{ $it['src'] }}" data-cap="{{ $it['caption'] }}" data-label="{{ $it['label'] }}" aria-label="Perbesar: {{ $it['caption'] ?: $it['label'] }}"
                                class="group block aspect-[4/3] w-full cursor-zoom-in overflow-hidden bg-[#F4F9FF] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-[#1677FF]">
                            <img src="{{ $it['src'] }}" alt="{{ $it['caption'] ?: $it['label'] }}" loading="lazy" decoding="async" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </button>
                        <figcaption class="p-5">
                            <p class="text-[12.5px] font-semibold text-[#1677FF]">{{ $it['group'] }} · {{ $it['label'] }}</p>
                            @if($it['caption'])
                                <p class="mt-1 text-[14px] font-medium leading-snug text-[#0B1B3A]">{{ $it['caption'] }}</p>
                            @endif
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        @endif

        {{-- Catatan dan arsip dari database (opsional, diisi lewat panel admin) --}}
        @if(count($docs))
            <div class="{{ $items->isNotEmpty() ? 'mt-20' : '' }}">
                <h2 class="mb-8 text-[26px] font-bold text-[#0B1B3A]">Catatan dan arsip</h2>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($docs as $doc)
                        <article class="flex flex-col overflow-hidden rounded-[24px] border border-[#DCE7F5] bg-white shadow-sm">
                            @if(!empty($doc->file_attachment))
                                <div class="aspect-[16/10] overflow-hidden bg-[#F4F9FF]">
                                    <img src="{{ asset('storage/' . $doc->file_attachment) }}" alt="{{ $doc->title }}" loading="lazy" class="h-full w-full object-cover">
                                </div>
                            @endif
                            <div class="flex flex-1 flex-col p-7">
                                @if(!empty($doc->category))
                                    <span class="mb-3 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-semibold text-[#1677FF]">{{ $doc->category }}</span>
                                @endif
                                <h3 class="mb-3 text-[18px] font-bold leading-snug text-[#0B1B3A]">{{ $doc->title }}</h3>
                                <p class="mb-5 line-clamp-3 text-[14px] leading-relaxed text-[#64748B]">{{ strip_tags($doc->content ?? '') }}</p>
                                @if(!empty($doc->updated_at))
                                    <p class="mt-auto border-t border-[#EEF3FA] pt-4 text-[13px] text-[#64748B]">Diperbarui {{ $doc->updated_at->format('d M Y') }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        @if($items->isEmpty() && !count($docs))
            <div class="rounded-[24px] border border-dashed border-[#DCE7F5] bg-white px-6 py-16 text-center">
                <h2 class="mb-2 text-[18px] font-bold text-[#0B1B3A]">Dokumentasi sedang disiapkan</h2>
                <p class="mx-auto max-w-md text-[14.5px] leading-relaxed text-[#64748B]">Sementara itu, dokumentasi tiap sistem dapat dilihat di halaman detail proyek.</p>
                <a href="{{ route('projects') }}" class="mt-6 inline-flex h-[46px] items-center rounded-full bg-gradient-to-r from-[#0A72FF] to-[#5F4FEE] px-7 text-[14px] font-semibold text-white">Lihat Proyek</a>
            </div>
        @endif
    </div>
</section>

@if($items->isNotEmpty())
<dialog id="docModal" aria-label="Pratinjau dokumentasi" class="m-auto w-[94vw] max-w-[980px] overflow-hidden rounded-[24px] border-0 bg-white p-0 shadow-2xl">
    <div class="relative bg-[#0B1B3A] p-4 sm:p-6">
        <img id="docImg" alt="" class="mx-auto max-h-[72vh] w-auto max-w-full rounded-lg object-contain">
        <button type="button" id="docPrev" aria-label="Sebelumnya" class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow hover:bg-white"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg></button>
        <button type="button" id="docNext" aria-label="Berikutnya" class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow hover:bg-white"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>
    </div>
    <div class="flex items-center justify-between gap-4 px-5 py-4">
        <div>
            <p id="docCap" class="text-[14.5px] font-semibold text-[#0B1B3A]"></p>
            <p id="docMeta" class="text-[12.5px] text-[#64748B]"></p>
        </div>
        <button type="button" id="docClose" class="rounded-full border border-[#DCE7F5] px-5 py-2 text-[13.5px] font-semibold text-[#0B1B3A] hover:bg-[#F4F9FF]">Tutup</button>
    </div>
</dialog>

<script>
(() => {
    const tiles = [...document.querySelectorAll('[data-doc]')];
    const modal = document.getElementById('docModal');
    if (!modal || !tiles.length) return;

    const img = document.getElementById('docImg'), cap = document.getElementById('docCap'), meta = document.getElementById('docMeta');
    let visible = tiles, i = 0;

    const show = () => {
        const b = visible[i].querySelector('[data-open]');
        img.src = b.dataset.src; img.alt = b.dataset.cap || b.dataset.label;
        cap.textContent = b.dataset.cap || b.dataset.label;
        meta.textContent = b.dataset.label + ' · ' + (i + 1) + ' dari ' + visible.length;
    };
    const step = (d) => { i = (i + d + visible.length) % visible.length; show(); };

    tiles.forEach((t) => t.querySelector('[data-open]').addEventListener('click', () => {
        i = visible.indexOf(t); show(); modal.showModal();
    }));

    document.querySelectorAll('.doc-chip').forEach((chip) => chip.addEventListener('click', () => {
        const f = chip.dataset.filter;
        tiles.forEach((t) => t.classList.toggle('hidden', f !== 'all' && t.dataset.group !== f));
        visible = tiles.filter((t) => !t.classList.contains('hidden'));
        document.querySelectorAll('.doc-chip').forEach((c) => {
            const on = c === chip;
            c.classList.toggle('bg-[#1677FF]', on); c.classList.toggle('text-white', on); c.classList.toggle('border-[#1677FF]', on);
            c.classList.toggle('bg-white', !on); c.classList.toggle('text-[#0B1B3A]', !on); c.classList.toggle('border-[#DCE7F5]', !on);
        });
    }));

    document.getElementById('docPrev').addEventListener('click', () => step(-1));
    document.getElementById('docNext').addEventListener('click', () => step(1));
    document.getElementById('docClose').addEventListener('click', () => modal.close());
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.close(); });
    modal.addEventListener('keydown', (e) => { if (e.key === 'ArrowLeft') step(-1); if (e.key === 'ArrowRight') step(1); });
    modal.addEventListener('close', () => img.removeAttribute('src'));
})();
</script>
@endif
@endsection