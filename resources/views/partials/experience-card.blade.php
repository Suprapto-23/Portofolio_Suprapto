{{-- Kartu pengalaman. Variabel: $exp (array), $i (nomor urut) --}}
<article class="flex flex-col rounded-[24px] border border-[#DCE7F5] bg-white p-8 shadow-sm transition-all duration-300 hover:border-[#1677FF]/40 hover:shadow-[0_20px_40px_-15px_rgba(22,119,255,0.15)]" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <span class="mb-4 self-start rounded-md bg-[#EAF6FF] px-3 py-1 text-[12px] font-bold text-[#1677FF]">{{ $exp['period'] }}</span>
                    <h3 class="text-[20px] font-bold leading-tight text-[#0B1B3A]">{{ $exp['role'] }}</h3>
                    <p class="mb-5 mt-1 text-[14.5px] font-medium text-[#64748B]">{{ $exp['org'] }}</p>

                    <ul class="mb-6 space-y-3 text-[14.5px] leading-relaxed text-[#475569]">
                        @foreach($exp['points'] as $point)
                            <li class="flex items-start gap-3">
                                <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#1677FF]"></span>
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-auto flex flex-wrap items-center gap-2 border-t border-gray-100 pt-5">
                        @foreach($exp['tags'] as $tag)
                            <span class="rounded-full border border-[#DCE7F5] bg-[#F4F9FF] px-3 py-1 text-[12px] font-semibold text-[#0B1B3A]">{{ $tag }}</span>
                        @endforeach
                        @foreach($exp['links'] as [$label, $url])
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="ml-auto inline-flex items-center gap-1.5 text-[13px] font-bold text-[#1677FF] hover:text-[#0A6CFF] first:ml-0">
                                {{ $label }}
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                            </a>
                        @endforeach
                    </div>
                </article>
