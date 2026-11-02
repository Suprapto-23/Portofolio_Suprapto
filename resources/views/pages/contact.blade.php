@extends('layouts.app')

@section('content')
@php
    $links = config('portfolio_site.links', []);
    $email = $links['email'] ?? 'ssuprapto351@gmail.com';
    $contacts = [
        ['Email', $email, 'mailto:'.$email, 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
        ['WhatsApp', '+62 812 2995 2175', 'https://wa.me/6281229952175', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
        ['Lokasi', 'Kab. Pekalongan, Jawa Tengah', null, 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
        ['LinkedIn', 'linkedin.com/in/supraptokulo', $links['linkedin'] ?? 'https://linkedin.com/in/supraptokulo', 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
        ['GitHub', 'github.com/Suprapto-23', $links['github'] ?? 'https://github.com/Suprapto-23', 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
    ];
    $field = 'w-full rounded-xl border border-[#DCE7F5] bg-[#FAFCFF] px-4 py-3 text-[15px] text-[#0B1B3A] placeholder:text-[#94A3B8] transition focus:border-[#1677FF] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1677FF]/20';
    $label = 'text-[14px] font-semibold text-[#0B1B3A]';
@endphp

<section class="relative bg-[#FAFCFF] pb-24 pt-28 lg:pt-36">
    <div class="mx-auto max-w-[1180px] px-6">

        <div class="mx-auto mb-14 max-w-[640px] text-center" data-aos="fade-up">
            <span class="mb-4 inline-block rounded-full bg-[#EAF6FF] px-4 py-1.5 text-[13px] font-semibold text-[#1677FF]">Hubungi Saya</span>
            <h1 class="mb-4 text-[34px] font-extrabold leading-tight text-[#0B1B3A] md:text-[44px]">
                Mari <span class="bg-gradient-to-r from-[#1677FF] to-[#063B91] bg-clip-text text-transparent">Berkolaborasi</span>
            </h1>
            <p class="text-[16px] leading-relaxed text-[#64748B]">
                Terbuka untuk kesempatan magang, posisi Junior Web Programmer, dan kolaborasi proyek web. Kirim pesan lewat formulir atau hubungi saya langsung.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">

            <aside class="flex flex-col gap-6 lg:col-span-5" data-aos="fade-right">
                <div class="rounded-[24px] border border-[#DCE7F5] bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="mb-4 text-[20px] font-bold text-[#0B1B3A]">Informasi Kontak</h2>
                    <ul class="flex flex-col gap-1">
                        @foreach ($contacts as [$name, $value, $href, $icon])
                            @php $tag = $href ? 'a' : 'div'; @endphp
                            <li>
                                <{{ $tag }} @if($href) href="{{ $href }}" @if(str_starts_with($href, 'http')) target="_blank" rel="noopener" @endif @endif class="group flex items-center gap-4 rounded-2xl p-3 transition hover:bg-[#F3F8FF]">
                                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#EAF6FF] text-[#1677FF] transition group-hover:bg-[#1677FF] group-hover:text-white">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                                    </span>
                                    <span class="min-w-0">
                                        <span class="block text-[12px] font-bold uppercase tracking-wider text-[#64748B]">{{ $name }}</span>
                                        <span class="block break-words text-[15px] font-medium text-[#0B1B3A]">{{ $value }}</span>
                                    </span>
                                </{{ $tag }}>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex items-start gap-3 rounded-[24px] border border-[#DCE7F5] bg-gradient-to-br from-[#EAF6FF] to-white p-6">
                    <span class="relative mt-1.5 flex h-2.5 w-2.5 shrink-0">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#1677FF] opacity-60"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-[#1677FF]"></span>
                    </span>
                    <p class="text-[14px] leading-relaxed text-[#475569]">
                        <strong class="font-semibold text-[#0B1B3A]">Terbuka untuk peluang baru.</strong>
                        Magang atau posisi Junior Web Programmer (Laravel, PHP, MySQL).
                    </p>
                </div>
            </aside>

            <div class="lg:col-span-7" data-aos="fade-left">
                <div class="rounded-[24px] border border-[#DCE7F5] bg-white p-6 shadow-[0_15px_40px_-15px_rgba(22,119,255,0.1)] sm:p-8 lg:p-10">
                    <h2 class="mb-1 text-[20px] font-bold text-[#0B1B3A]">Kirim Pesan</h2>
                    <p class="mb-6 text-[14px] text-[#64748B]">Pesan akan terbuka di aplikasi email Anda, tinggal klik kirim.</p>

                    <form id="contact-form" class="flex flex-col gap-5">
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="flex flex-col gap-2">
                                <label for="c-nama" class="{{ $label }}">Nama Lengkap</label>
                                <input id="c-nama" name="nama" type="text" required autocomplete="name" placeholder="Nama Anda" class="{{ $field }}">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="c-email" class="{{ $label }}">Alamat Email</label>
                                <input id="c-email" name="email" type="email" required autocomplete="email" placeholder="nama@email.com" class="{{ $field }}">
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="c-subjek" class="{{ $label }}">Subjek</label>
                            <input id="c-subjek" name="subjek" type="text" placeholder="Contoh: Informasi lowongan magang" class="{{ $field }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="c-pesan" class="{{ $label }}">Pesan</label>
                            <textarea id="c-pesan" name="pesan" rows="5" required minlength="10" placeholder="Tulis pesan Anda di sini..." class="{{ $field }} resize-none"></textarea>
                        </div>
                        <button type="submit" class="mt-1 flex h-[52px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#063B91] to-[#1677FF] text-[15px] font-bold text-white shadow-lg shadow-blue-500/30 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl">
                            Kirim Pesan
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.getElementById('contact-form').addEventListener('submit', function (e) {
        e.preventDefault();
        var f = e.target;
        var v = function (n) { return f.elements[n].value.trim(); };
        var subject = v('subjek') || 'Pesan dari portofolio';
        var body = v('pesan') + '\n\n--\n' + v('nama') + ' (' + v('email') + ')';
        window.location.href = 'mailto:{{ $email }}?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
    });
</script>
@endsection