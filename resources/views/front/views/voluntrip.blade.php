<section id="voluntrip-section" class="mt-8">
    <div class="flex items-center justify-between px-4">
        <h2 class="text-lg font-bold">Voluntrip <br> Relawan + Jalan-Jalan</h2>
        <a href="" class="rounded-full bg-[#E8E9EE] p-[6px_12px] text-sm font-semibold">Explore All</a>
    </div>
    <div class="mt-[14px] grid gap-4 px-4 md:grid-cols-2">

        @forelse($voluntrips as $voluntrip)
            <div class="card-item flex max-h-fit flex-col overflow-hidden rounded-lg border bg-white shadow-md">
                <div class="thumbnail">
                    <img src="{{ Storage::url($voluntrip->thumbnail) }}" alt="thumbnail" style="height: 250px;"
                        class="h-[200px] w-full">
                </div>
                <div class="card-container flex h-full flex-col justify-between gap-5 px-3 pt-3">
                    <div class="card-body flex flex-col gap-2 break-words">
                        <div class="flex flex-col gap-1">
                            <h4 class="title-voluntrip text-sm font-bold">{{ $voluntrip->name }}</h4>
                            <div class="flex items-center gap-1">
                                <p class="fundraiser text-[12px] font-medium">
                                    {{ $voluntrip->fundraiser->user->hasRole('owner') ? 'By Owner' : $voluntrip->fundraiser->user->name }}
                                </p>
                                <div class="flex shrink-0">
                                    <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" alt="icon">
                                </div>
                            </div>
                        </div>
                        <p class="line-clamp-2 text-sm">{{ $voluntrip->about }}</p>
                    </div>
                    <div class="donation-section flex items-center justify-between gap-2 border-t-2 px-2 py-4">
                        <div class="flex flex-col">
                            <p class="text-sm">Ticket Price</p>
                            <h3 class="font-medium">Rp{{ $voluntrip->ticket_price }}</h3>
                        </div>
                        <a href="{{ route('front.voluntrip.details', $voluntrip) }}"
                            class="items-center rounded-md bg-blue-400 px-4 py-2 text-[14px] text-white">Voluntrip
                            Detail</a>
                    </div>
                </div>
            </div>

        @empty
            <p>Belum Ada Event Tersedia</p>
        @endforelse
    </div>
</section>
