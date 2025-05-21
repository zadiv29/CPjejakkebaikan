<section id="voluntrip-section" class="mt-8">
    <div class="flex items-center justify-between px-4">
        <h2 class="text-lg font-bold">Voluntrip <br> Relawan + Jalan-Jalan</h2>
        <a href="" class="rounded-full bg-[#E8E9EE] p-[6px_12px] text-sm font-semibold">Explore All</a>
    </div>
    <!-- Horizontal Scroll Carousel -->
    <!-- Carousel Wrapper -->
    <div class="mt-[14px] overflow-x-auto scroll-smooth px-4">
        <div class="flex w-max snap-x snap-mandatory scroll-pl-6 gap-4 pb-4">
            @forelse($voluntrips as $voluntrip)
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
                <p>Belum Ada Event Tersedia</p>
            @endforelse
        </div>
    </div>
</section>
