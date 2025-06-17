@extends('front.layouts.app')
@section('title', 'Explore Donasimu')
@section('content')
    <section class="mx-auto flex min-h-screen w-full max-w-[640px] flex-col overflow-x-hidden bg-white">
        <div class="header relative -mb-[92px] flex h-[350px] flex-col overflow-hidden bg-[#56BBC5]">
            <nav class="relative z-20 flex items-center justify-between px-3 pt-5">
                <div class="flex items-center gap-[10px]">
                    <a href="{{ route('front.index') }}" class="flex h-10 w-10 shrink-0">
                        <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
                    </a>
                </div>
                <div class="flex flex-col items-center text-center">
                    <p class="text-xs leading-[18px] text-white"></p>
                    <p class="text-sm font-semibold text-white">#BersamaJejakKebaikan</p>
                </div>
                <a href="" class="flex h-10 w-10 shrink-0">
                    <img src="{{ asset('assets/images/icons/like.svg') }}" alt="icon">
                </a>
            </nav>
            <div class="absolute h-full w-full overflow-hidden bg-white">
                <div class="absolute z-10 h-[266px] w-full bg-gradient-to-b from-black/90 to-[#080925]/0"></div>
                <img src="{{ Storage::url($fundraising->thumbnail) }}" class="h-full w-full object-cover" alt="cover">
            </div>
        </div>
        <div class="z-30 flex flex-col">

            @if ($fundraising->has_finished)
                <div id="status"
                    class="-mb-[38px] flex h-[92px] w-full items-center justify-center gap-2 rounded-t-[40px] bg-[#76AE43] pb-[50px] pt-3">
                    <div class="flex h-[30px] w-[30px] shrink-0">
                        <img src="{{ asset('assets/images/icons/lovely.svg') }}" alt="icon">
                    </div>
                    <p class="text-sm font-semibold text-white">Terima Kasih Donasi Telah Mencapai Target</p>
                </div>
            @else
                <div id="status"
                    class="-mb-[38px] flex h-[92px] w-full items-center justify-center gap-2 rounded-t-[40px] bg-[#FF7815] pb-[50px] pt-3">
                    <div class="flex h-[30px] w-[30px] shrink-0">
                        <img src="{{ asset('assets/images/icons/lovely.svg') }}" alt="icon">
                    </div>
                    <p class="text-sm font-semibold text-white">Berikan Donasi Terbaikmu</p>
                </div>
            @endif

            <div id="content" class="flex w-full flex-col gap-5 rounded-t-[40px] bg-white p-[30px_24px_120px]">
                <div class="flex flex-col gap-[10px]">
                    @if ($fundraising->has_finished)
                        <p
                            class="badge w-fit rounded-full bg-[#76AE43] p-[6px_12px] text-xs font-bold leading-[18px] text-white">
                            FINISHED</p>
                    @else
                        <p
                            class="badge w-fit rounded-full bg-[#40BCD9] p-[6px_12px] text-xs font-bold leading-[18px] text-white">
                            IN PROGRESS</p>
                    @endif
                    <h1 class="text-[26px] font-extrabold leading-[39px]">{{ $fundraising->name }}</h1>
                    <div class="flex items-center gap-2">
                        <div class="flex h-9 w-9 shrink-0 overflow-hidden rounded-full">
                            <img src="{{ Storage::url($fundraising->fundraiser->user->avatar) }}"
                                class="h-full w-full object-cover" alt="photo">
                        </div>
                        <div class="flex items-center gap-1">
                            <p class="text-sm font-semibold">{{ $fundraising->fundraiser->user->name }}</p>
                            <div class="flex shrink-0">
                                <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <h2 class="text-sm font-semibold">Progress</h2>
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-[#66697A]">Rp
                            {{ number_format($fundraising->totalReachedAmount(), 0, ',', '.') }}</p>
                        <p class="text-[20px] font-bold leading-[30px] text-[#76AE43]">Rp
                            {{ number_format($fundraising->target_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="relative mt-2 h-[8px] w-full overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full bg-[#90CFF1] transition-all duration-300 ease-in-out"
                            style="width: {{ $fundraising->getPercentageAttribute() }}%;"></div>
                    </div>
                </div>

                @forelse($fundraising->fundraising_phases as $phase)
                    <div class="flex flex-col gap-[10px] rounded-[20px] bg-[#F6ECE2] p-5">
                        <h2 class="text-sm font-semibold">{{ $phase->name }}</h2>
                        <div class="aspect-[61/30] overflow-hidden rounded-2xl bg-[#D9D9D9]">
                            <img src="{{ Storage::url($phase->photo) }}" class="h-full w-full object-cover"
                                alt="thumbnail">
                        </div>
                        <p class="text-sm leading-[26px]">{{ $phase->notes }}</p>
                    </div>
                @empty
                @endforelse

                <div class="flex flex-col gap-[2px]">
                    <h2 class="text-sm font-semibold">About</h2>
                    <p class="desc-less text-sm leading-[26px]">{{ $fundraising->about }}</p>
                    <p class="desc-more hidden text-sm leading-[26px]"><button class="text-[#FF7815] underline"
                            onclick="toggleSeeMoreLess()">see less</button></p>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-semibold">Supporters ({{ $fundraising->donaturs->count() }})</h2>
                        <a href="" class="rounded-full bg-[#E8E9EE] p-[6px_12px] text-sm font-semibold">View All</a>
                    </div>
                    <div class="flex flex-col gap-4">

                        @forelse($fundraising->donaturs as $donatur)
                            <div class="flex items-center gap-3">
                                <div class="flex h-[50px] w-[50px] shrink-0 overflow-hidden rounded-full">
                                    <img src="{{ asset('assets/images/photos/avatar-default.svg') }}"
                                        class="h-full w-full object-cover" alt="avatar">
                                </div>
                                <div class="flex w-full flex-col gap-[2px]">
                                    <div class="flex items-center justify-between">
                                        <p class="font-bold">Rp {{ number_format($donatur->payment->amount, 0, ',', '.') }}
                                        </p>
                                        <p class="text-right text-[10px] font-semibold leading-[15px] text-[#66697A]">by
                                            {{ $donatur->name }}</p>
                                    </div>
                                    <p class="caption text-xs leading-[18px] text-[#66697A]">“{{ $donatur->notes }}”</p>
                                </div>
                            </div>
                        @empty
                            <p>
                                Belum Ada Yang Berdonasi
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @if (!$goalReached)
            <a href="{{ route('front.checkout', $fundraising->slug) }}"
                class="fixed bottom-[30px] left-1/2 z-40 mx-auto w-fit -translate-x-1/2 transform text-nowrap rounded-full bg-[#76AE43] p-[14px_20px] font-semibold text-white transition-all duration-300 hover:shadow-[0_12px_20px_0_#76AE4380]">Send
                My Support Now</a>
        @endif
    </section>
@endsection
