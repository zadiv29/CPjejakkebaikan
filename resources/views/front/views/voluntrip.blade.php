<section id="voluntrip-section" class="mt-8 px-2">
    <div class="flex items-center justify-between rounded-md bg-gray-100 px-4 py-2 shadow-md">
        <h2 class="text-[14px] font-bold sm:text-lg">Voluntrip Relawan + Jalan-Jalan</h2>
        <a href="#" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:underline">
            Explore All
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
    <!-- Horizontal Scroll Carousel -->
    <!-- Carousel Wrapper -->
    <div class="mt-[14px] overflow-x-auto scroll-smooth px-4">
        @forelse($voluntrips as $voluntrip)
            <div class="flex w-max snap-x snap-mandatory scroll-pl-6 gap-4 pb-4">
                @if ($voluntrip->event_status === 'active')
                    <div
                        class="card-item flex w-[260px] snap-start flex-col overflow-hidden rounded-lg border bg-white shadow-md">
                        <!-- Thumbnail -->
                        <a href="{{ route('front.voluntrip.details', $voluntrip) }}" class="thumbnail">
                            <img src="{{ Storage::url($voluntrip->thumbnail) }}" alt="thumbnail"
                                class="h-40 w-full object-cover">
                        </a>

                        <!-- Card Body + Footer -->
                        <div class="flex h-full flex-col justify-between">
                            <!-- Card Content -->
                            <div class="flex flex-col gap-2 px-3 pt-3">
                                <a href="{{ route('front.voluntrip.details', $voluntrip) }}"
                                    class="line-clamp-2 text-sm font-bold">{{ $voluntrip->name }}</a>
                                <p class="flex items-center gap-1 text-[12px] font-medium text-gray-400">
                                    <x-icon.date />
                                    {{ \Carbon\Carbon::parse($voluntrip->start_date)->format('d F Y') }}
                                </p>
                                <h3 class="text-xs font-medium">
                                    Rp{{ number_format($voluntrip->ticket_price, 0, ',', '.') }}
                                </h3>
                            </div>

                            <!-- Footer -->
                            <div
                                class="card-footer mt-3 flex items-center gap-3 border-b-4 border-t border-b-[#c4e5f850] px-3 py-3">
                                <div class="h-9 w-9 flex-shrink-0 overflow-hidden rounded-full">
                                    <img src="{{ Storage::url($voluntrip->fundraiser->user->avatar) }}"
                                        class="h-full w-full object-cover" alt="photo">
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-[12px]">Diselenggarakan oleh</p>
                                    <p class="text-[12px] font-bold">{{ $voluntrip->fundraiser->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div
                    class="flex w-full flex-col items-center justify-center gap-3 p-8 text-center text-sm text-gray-500">
                    <lottie-player src="{{ asset('lottie/empty.json') }}" background="transparent" speed="1"
                        style="width: 200px; height: 200px;" loop autoplay>
                    </lottie-player>
                    <p class="font-medium">Belum ada pilihan donasi untuk kamu saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>
