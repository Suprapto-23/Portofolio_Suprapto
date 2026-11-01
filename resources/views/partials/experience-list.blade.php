{{-- Daftar pengalaman: foto/dokumentasi di KIRI (slider), deskripsi di KANAN. Sumber: config('portfolio.experiences') --}}
<style>
    .exp-track { scrollbar-width: none; -ms-overflow-style: none; }
    .exp-track::-webkit-scrollbar { display: none; }
</style>

<div class="flex flex-col gap-6">
    @foreach(config('portfolio.experiences', []) as $exp)
        @php
            $photos    = $exp['photos'] ?? [];
            $hasPhotos = count($photos) > 0;
        @endphp

        <article class="grid grid-cols-1 items-start gap-6 rounded-[22px] border border-[#DCE7F5] bg-white p-5 shadow-sm md:grid-cols-2 md:p-6" data-aos="fade-up">

            {{-- KIRI: kotak foto dengan slider --}}
            <div class="min-w-0">
                <div class="relative aspect-video w-full overflow-hidden rounded-2xl bg-[#F4F9FF]" @if($hasPhotos) data-slider @endif>
                    @if($hasPhotos)
                        <div class="exp-track absolute inset-0 flex snap-x snap-mandatory overflow-x-auto scroll-smooth" data-track>
                            @foreach($photos as [$img, $caption])
                                <figure class="relative h-full w-full shrink-0 snap-center">
                                    <img src="{{ asset($img) }}" alt="{{ $caption }}" loading="lazy" class="h-full w-full object-cover" onerror="this.style.display='none'">
                                    <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent px-4 pb-3 pt-10 text-[13px] font-medium leading-snug text-white">{{ $caption }}</figcaption>
                                </figure>
                            @endforeach
                        </div>

                        @if(count($photos) > 1)
                            <span data-counter class="absolute right-3 top-3 rounded-full bg-black/55 px-2.5 py-1 text-[11.5px] font-semibold text-white">1 / {{ count($photos) }}</span>

                            <button type="button" data-prev aria-label="Foto sebelumnya" class="absolute left-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                            </button>
                            <button type="button" data-next aria-label="Foto berikutnya" class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </button>
                        @endif
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 px-6 text-center">
                            <svg class="h-8 w-8 text-[#1677FF]/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h3l2-2h6l2 2h3v12H4z"/><circle cx="12" cy="13" r="3.5"/></svg>
                            <p class="text-[13px] font-semibold text-[#64748B]">Dokumentasi belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- KANAN: deskripsi --}}
            <div class="flex min-w-0 flex-col">
                <span class="mb-3 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-bold text-[#1677FF]">{{ $exp['period'] }}</span>
                <h3 class="text-[19px] font-bold leading-tight text-[#0B1B3A]">{{ $exp['role'] }}</h3>
                <p class="mb-4 mt-1 text-[14px] font-medium text-[#64748B]">{{ $exp['org'] }}</p>

                <ul class="mb-5 space-y-2.5 text-[14.5px] leading-relaxed text-[#475569]">
                    @foreach($exp['points'] as $point)
                        <li class="flex items-start gap-3">
                            <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-auto flex flex-wrap items-center gap-2 border-t border-gray-100 pt-4">
                    @foreach($exp['tags'] ?? [] as $tag)
                        <span class="rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-3 py-1 text-[12px] font-semibold text-[#0B1B3A]">{{ $tag }}</span>
                    @endforeach
                    @foreach($exp['links'] ?? [] as [$label, $url])
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="ml-auto inline-flex items-center gap-1.5 text-[13px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">
                            {{ $label }}
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>
        </article>
    @endforeach
</div>

<script>
(() => {
    if (window.__expSliderReady) return;
    window.__expSliderReady = true;

    const trackOf = (root) => root.querySelector('[data-track]');

    const updateCounter = (root) => {
        const t = trackOf(root);
        const counter = root.querySelector('[data-counter]');
        if (!t || !counter) return;
        const total = t.children.length;
        const i = Math.min(total - 1, Math.round(t.scrollLeft / t.clientWidth));
        counter.textContent = (i + 1) + ' / ' + total;
    };

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-prev], [data-next]');
        if (!btn) return;
        const t   = trackOf(btn.closest('[data-slider]'));
        const dir = btn.hasAttribute('data-next') ? 1 : -1;
        const max = t.scrollWidth - t.clientWidth;

        if (dir > 0 && t.scrollLeft >= max - 4) {
            t.scrollTo({ left: 0, behavior: 'smooth' });
        } else if (dir < 0 && t.scrollLeft <= 4) {
            t.scrollTo({ left: max, behavior: 'smooth' });
        } else {
            t.scrollBy({ left: dir * t.clientWidth, behavior: 'smooth' });
        }
    });

    document.addEventListener('scroll', (e) => {
        if (e.target.matches && e.target.matches('[data-track]')) {
            updateCounter(e.target.closest('[data-slider]'));
        }
    }, true);
})();
</script>