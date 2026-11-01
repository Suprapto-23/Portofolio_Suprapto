<dialog id="lbModal" aria-labelledby="lbTitle" class="m-auto w-[94vw] max-w-[1000px] overflow-hidden rounded-[24px] border-0 bg-white p-0 shadow-2xl">
    <div class="grid max-h-[90vh] grid-cols-1 overflow-y-auto lg:grid-cols-[1.5fr_1fr] lg:overflow-hidden">
        <div class="relative flex items-center justify-center bg-[#0B1B3A] p-4 sm:p-6 lg:max-h-[90vh]">
            <img id="lbImg" alt="" class="max-h-[56vh] w-auto max-w-full rounded-lg object-contain shadow-xl lg:max-h-[78vh]">
            <button type="button" id="lbPrev" aria-label="Sebelumnya" class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>
            <button type="button" id="lbNext" aria-label="Berikutnya" class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-[#0B1B3A] shadow transition hover:bg-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>
        <div class="flex flex-col p-6 lg:max-h-[90vh] lg:overflow-y-auto lg:p-8">
            <div class="mb-5 flex items-center justify-between">
                <span id="lbCount" class="rounded-full bg-[#F4F9FF] px-3 py-1 text-[12.5px] font-semibold text-[#1677FF]"></span>
                <button type="button" id="lbClose" aria-label="Tutup" class="flex h-9 w-9 items-center justify-center rounded-full text-[#64748B] transition hover:bg-[#F4F9FF] hover:text-[#0B1B3A]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <h3 id="lbTitle" class="text-[19px] font-bold leading-snug text-[#0B1B3A]"></h3>
            <p id="lbSub" class="mt-2 hidden text-[14.5px] font-semibold text-[#1677FF]"></p>
            <p id="lbDate" class="mt-1 hidden text-[13.5px] text-[#64748B]"></p>
            <p id="lbNote" class="mt-3 hidden rounded-xl bg-[#F4F9FF] px-4 py-3 text-[13px] leading-relaxed text-[#0B1B3A]"></p>
            <p id="lbDesc" class="mt-5 hidden whitespace-pre-line text-[14px] leading-[1.8] text-[#64748B]"></p>
            <a id="lbLink" href="#" target="_blank" rel="noopener noreferrer" class="mt-6 hidden items-center gap-1.5 text-[13.5px] font-bold text-[#1677FF] hover:text-[#0A6CFF]">Verifikasi sertifikat</a>
        </div>
    </div>
</dialog>

<style>
    @keyframes lbPop { from { opacity: 0; transform: translateY(14px) scale(.98); } to { opacity: 1; transform: none; } }
    #lbModal[open] { animation: lbPop .28s ease-out; }
    #lbModal::backdrop { background: rgba(11, 27, 58, .72); backdrop-filter: blur(4px); }
    @media (prefers-reduced-motion: reduce) { #lbModal[open] { animation: none; } }
</style>

<script>
(() => {
    const modal = document.getElementById('lbModal');
    if (!modal) return;
    const $ = (id) => document.getElementById(id);
    let items = [], idx = 0;

    const setText = (id, v) => { const el = $(id); el.textContent = v || ''; el.classList.toggle('hidden', !v); };

    const render = () => {
        const d = items[idx].dataset;
        $('lbImg').src = d.lbSrc;
        $('lbImg').alt = d.lbTitle || '';
        $('lbTitle').textContent = d.lbTitle || '';
        setText('lbSub', d.lbSub); setText('lbDate', d.lbDate);
        setText('lbNote', d.lbNote); setText('lbDesc', d.lbDesc);
        const many = items.length > 1;
        $('lbPrev').classList.toggle('hidden', !many);
        $('lbNext').classList.toggle('hidden', !many);
        $('lbCount').textContent = (idx + 1) + ' dari ' + items.length;
        $('lbCount').classList.toggle('hidden', !many);
        const link = $('lbLink');
        link.classList.toggle('hidden', !d.lbUrl);
        link.classList.toggle('inline-flex', !!d.lbUrl);
        if (d.lbUrl) link.href = d.lbUrl;
    };
    const step = (n) => { idx = (idx + n + items.length) % items.length; render(); };

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-lb]');
        if (!btn) return;
        const g = btn.dataset.lbGroup || 'all';
        items = [...document.querySelectorAll('[data-lb]')].filter((x) => (x.dataset.lbGroup || 'all') === g && x.offsetParent !== null);
        idx = Math.max(0, items.indexOf(btn));
        render();
        modal.showModal();
        document.documentElement.classList.add('overflow-hidden');
    });
    $('lbClose').addEventListener('click', () => modal.close());
    $('lbPrev').addEventListener('click', () => step(-1));
    $('lbNext').addEventListener('click', () => step(1));
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.close(); });
    modal.addEventListener('close', () => document.documentElement.classList.remove('overflow-hidden'));
    modal.addEventListener('keydown', (e) => {
        if (items.length < 2) return;
        if (e.key === 'ArrowLeft') step(-1);
        if (e.key === 'ArrowRight') step(1);
    });
})();
</script>