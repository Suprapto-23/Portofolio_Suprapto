{{--
    KARTU ENTRI: Deskripsi di KIRI, Foto/Dokumentasi di KANAN (Desktop).
    Dipakai untuk Pendidikan, Pengalaman, serta Organisasi & Kegiatan.
    Param: $entry (array)
--}}
@php
    $e = $entry;

    // 1. Normalisasi data string tunggal / JSON string menjadi array
    $toArray = function($val) {
        if (is_array($val)) return $val;
        if (is_string($val)) {
            $decoded = json_decode($val, true);
            return is_array($decoded) ? $decoded : (trim($val) ? [$val] : []);
        }
        return [];
    };

    $points = $toArray($e['points'] ?? []);
    $tags   = $toArray($e['tags'] ?? []);
    $links  = $toArray($e['links'] ?? []);

    // 2. Normalisasi khusus untuk photos
    $rawPhotos = $e['photos'] ?? [];
    $photos = [];
    if (is_string($rawPhotos)) {
        $decoded = json_decode($rawPhotos, true);
        $photos = is_array($decoded) ? $decoded : (trim($rawPhotos) ? [[$rawPhotos, '']] : []);
    } elseif (is_array($rawPhotos)) {
        $photos = (!empty($rawPhotos) && !is_array(reset($rawPhotos))) ? [$rawPhotos] : $rawPhotos;
    }

    // 3. Paksa gunakan gambar dummy jika foto kosong (Tanpa teks panjang)
    if (empty($photos)) {
        $photos = [['images/project-sapi.png', '']];
    }

    $lbGroup = $e['group'] ?? uniqid('lb_');

    // 4. Helper pemetaan icon untuk Tools/Tech Stack (Menggunakan DevIcon)
    $iconMap = [
        'php' => 'php/php-original',
        'laravel' => 'laravel/laravel-original',
        'mysql' => 'mysql/mysql-original',
        'postgresql' => 'postgresql/postgresql-original',
        'html' => 'html5/html5-original',
        'css' => 'css3/css3-original',
        'javascript' => 'javascript/javascript-original',
        'tailwind' => 'tailwindcss/tailwindcss-original',
        'tailwind css' => 'tailwindcss/tailwindcss-original',
        'bootstrap' => 'bootstrap/bootstrap-original',
        'react' => 'react/react-original',
        'vue' => 'vuejs/vuejs-original',
        'node.js' => 'nodejs/nodejs-original',
        'python' => 'python/python-original',
        'java' => 'java/java-original',
        'git' => 'git/git-original',
        'github' => 'github/github-original',
        'figma' => 'figma/figma-original',
        'sqlite' => 'sqlite/sqlite-original',
        'mongodb' => 'mongodb/mongodb-original',
        'api' => 'postman/postman-original',
    ];

    $getIcon = function($tagName) use ($iconMap) {
        return $iconMap[strtolower(trim($tagName))] ?? null;
    };
@endphp

<style>
    .entry-track { scrollbar-width: none; -ms-overflow-style: none; }
    .entry-track::-webkit-scrollbar { display: none; }
</style>

<article class="grid grid-cols-1 items-center gap-6 rounded-[22px] border border-[#DCE7F5] bg-white p-5 shadow-sm md:grid-cols-[minmax(0,7fr)_minmax(0,5fr)] md:gap-8 md:p-6">

    {{-- KIRI: Deskripsi --}}
    <div class="order-2 flex min-w-0 flex-col md:order-1">
        @if(! empty($e['period']))
            <span class="mb-3 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-bold text-[#1677FF]">{{ $e['period'] }}</span>
        @endif
        <h3 class="text-[19px] font-bold leading-tight text-[#0B1B3A]">{{ $e['title'] ?? '' }}</h3>
        @if(! empty($e['org']))
            <p class="mb-4 mt-1 text-[14px] font-medium text-[#64748B]">{{ $e['org'] }}</p>
        @endif
        @if(! empty($e['lead']))
            <p class="mt-3 text-[14px] font-semibold text-[#0B1B3A]">{{ $e['lead'] }}</p>
        @endif
        @if(! empty($e['desc']))
            <p class="mt-3 text-[14.5px] leading-[1.75] text-[#5B6B82]">{{ $e['desc'] }}</p>
        @endif

        @if(count($points) > 0)
            <ul class="mb-5 mt-4 space-y-2.5 text-[14.5px] leading-relaxed text-[#475569]">
                @foreach($points as $point)
                    <li class="flex items-start gap-3">
                        <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                        <span>{{ $point }}</span>
                    </li>
                @endforeach
            </ul>
        @endif

        @if(count($tags) > 0 || count($links) > 0)
            <div class="mt-auto pt-2">
                <div class="flex flex-col gap-4 border-t border-[#E8EFF9] pt-4">
                    
                    @if(count($tags) > 0)
                        <div class="flex flex-wrap items-center gap-2.5">
                            @foreach($tags as $tag)
                                @php $iconSlug = $getIcon($tag); @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-lg border border-[#DCE7F5] bg-[#F4F9FF] px-2.5 py-1.5 text-[12px] font-semibold text-[#0B1B3A]">
                                    @if($iconSlug)
                                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.16.0/icons/{{ $iconSlug }}.svg" alt="" class="h-3.5 w-3.5 object-contain" aria-hidden="true" onerror="this.style.display='none'">
                                    @endif
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    @if(count($links) > 0)
                        <div class="flex flex-wrap items-center gap-5">
                            @foreach($links as $lnk)
                                @php
                                    $linkLabel = is_array($lnk) ? ($lnk[0] ?? 'Tautan') : $lnk;
                                    $linkUrl   = is_array($lnk) ? ($lnk[1] ?? '#') : $lnk;
                                @endphp
                                <a href="{{ $linkUrl }}" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center gap-1.5 text-[13px] font-bold text-[#1677FF] transition-all hover:text-[#0A6CFF]">
                                    <span class="border-b-2 border-transparent transition-colors group-hover:border-[#0A6CFF] pb-0.5">{{ $linkLabel }}</span>
                                    <svg class="h-3.5 w-3.5 transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                                </a>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        @endif
    </div>

    {{-- KANAN: Kotak foto/slider --}}
    <div class="order-1 min-w-0 md:order-2">
        <div class="relative aspect-video w-full overflow-hidden rounded-2xl bg-[#F4F9FF]" data-slider>
            <div class="entry-track absolute inset-0 flex snap-x snap-mandatory overflow-x-auto scroll-smooth" data-track>
                @foreach($photos as $pItem)
                    @php
                        $img = $pItem[0] ?? '';
                        $caption = $pItem[1] ?? '';
                    @endphp
                    <figure class="group/img relative h-full w-full shrink-0 snap-center overflow-hidden">
                        <button type="button" 
                                class="block h-full w-full focus:outline-none text-left"
                                data-lb 
                                data-lb-src="{{ asset($img) }}" 
                                data-lb-title="{{ $caption }}" 
                                data-lb-group="{{ $lbGroup }}"
                                aria-label="Perbesar gambar">
                            
                            <img src="{{ asset($img) }}" alt="{{ $caption }}" loading="lazy" 
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover/img:scale-105" 
                                 onerror="const f='{{ asset('images/project-sapi.png') }}'; this.src=f; this.closest('[data-lb]').dataset.lbSrc=f; this.onerror=null;">
                            
                            {{-- Efek Kaca Pembesar --}}
                            <div class="absolute inset-0 flex items-center justify-center bg-[#0B1B3A]/0 opacity-0 transition-all duration-300 group-hover/img:bg-[#0B1B3A]/20 group-hover/img:opacity-100">
                                <div class="rounded-full bg-white/95 p-2.5 text-[#1677FF] shadow-lg transform scale-75 transition-transform duration-300 group-hover/img:scale-100">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                                </div>
                            </div>

                            @if($caption)
                                <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent px-3 pb-2 pt-10 text-[11.5px] font-medium leading-snug text-white md:px-4 md:pb-3 md:text-[13px]">{{ $caption }}</figcaption>
                            @endif
                        </button>
                    </figure>
                @endforeach
            </div>

            @if(count($photos) > 1)
                <span data-counter class="pointer-events-none absolute right-3 top-3 rounded-full bg-black/55 px-2.5 py-1 text-[11.5px] font-semibold text-white">1 / {{ count($photos) }}</span>

                <button type="button" data-prev aria-label="Foto sebelumnya" class="absolute left-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button type="button" data-next aria-label="Foto berikutnya" class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            @endif
        </div>
    </div>

</article>