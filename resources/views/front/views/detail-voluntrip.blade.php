@extends('front.layouts.app')
@section('title', 'Voluntrip Detail')
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
                    <p class="text-sm font-semibold text-white">#Voluntrip</p>
                    <p class="text-sm font-semibold text-white">Relawan + Jalan-Jalan</p>
                </div>
                <a href="" class="flex h-10 w-10 shrink-0">
                    <img src="{{ asset('assets/images/icons/like.svg') }}" alt="icon">
                </a>
            </nav>
            <div class="absolute h-full w-full overflow-hidden bg-white">
                <div class="absolute z-10 h-[266px] w-full bg-gradient-to-b from-black/90 to-[#080925]/0"></div>
                <img src="{{ Storage::url($voluntrip->thumbnail) }}" class="h-full w-full object-cover" alt="cover">
            </div>
        </div>
        <div class="z-30 flex flex-col pb-[24px]">
            <div id="content" class="flex w-full flex-col gap-5 rounded-t-[40px] bg-white">
                <div class="flex flex-col gap-4" x-data="{ tab: 'deskripsi' }">
                    <section class="flex flex-col gap-3 px-[24px] pt-[24px]">
                        <h4 class="font-bold">{{ $voluntrip->name }}</h4>
                        <div class="flex flex-col gap-1">
                            <span class="flex items-center gap-2 text-[12px] font-normal"><x-icon.date />
                                {{ $date }}</span>
                            <span class="flex items-center gap-2 text-[12px] font-normal"><x-icon.time />{{ $timeStart }}
                                -
                                {{ $timeEnd }}</span>
                            <span class="flex items-center gap-2 text-[12px] font-normal"><x-icon.location /> Jalan Tluki,
                                Condong Catur
                                Yogyakarta</span>
                        </div>
                    </section>
                    <section class="flex w-full gap-3 border-b-4 border-t border-b-[#c4e5f850] px-[24px] py-3">
                        <div class="flex h-9 w-9 shrink-0 overflow-hidden rounded-full">
                            <img src="{{ Storage::url($voluntrip->fundraiser->user->avatar) }}"
                                class="h-full w-full object-cover" alt="photo">
                        </div>
                        <div class="flex flex-col">
                            <p class="text-[12px]">Diselengarakan oleh</p>
                            <p class="text-[12px] font-bold">{{ $voluntrip->fundraiser->user->name }}</p>
                        </div>
                    </section>
                    <section class="flex justify-between">
                        <button @click="tab = 'deskripsi'"
                            :class="tab === 'deskripsi' ? 'border-blue-500' : 'border-transparent'"
                            class="w-full border-b-2 pb-1 text-center">Deskripsi</button>

                        <button @click="tab = 'tiket'"
                            :class="tab === 'tiket' ? 'border-blue-500' : 'border-transparent'"
                            class="w-full border-b-2 pb-1 text-center">Tiket</button>
                    </section>
                    {{-- #ANCHOR Deskripsi --}}
                    <section class="flex flex-col gap-4" x-show="tab === 'deskripsi'">

                        <section class="flex flex-col gap-3 break-words px-[24px]">
                            <div class="flex min-h-fit items-center gap-2">
                                <hr class="h-5 w-1 rounded-r-md bg-blue-500">
                                <h4 class="text-md font-medium">
                                    Tentang Program
                                </h4>
                            </div>
                            <p class="text-[13px]">{{ $voluntrip->about }}</p>
                        </section>
                        <section class="flex flex-col gap-3 break-words px-[24px]">
                            <div class="flex min-h-fit items-center gap-2">
                                <hr class="h-5 w-1 rounded-r-md bg-blue-500">
                                <h4 class="text-md font-medium">Manfaat/Benefit Program</h4>
                            </div>
                            {{-- //NOTE belum ada data untuk manfaat di db  --}}
                            <p class="text-[13px]">{{ $voluntrip->about }} Allah SWT berfirman: "Sesungguhnya orang-orang
                                yang
                                membenarkan (Allah dan Rasul-Nya) baik laki-laki maupun perempuan dan meminjamkan kepada
                                Allah
                                peinjaman yang baik, niscaya akan dilipat gandakan (pembayarannya) kepada mereka; dan bagi
                                mereka pahala yang banyak." (QS. Al hadid: 18)</p>
                        </section>
                    </section>
                    {{-- #ANCHOR Tiket --}}
                    <section x-show="tab === 'tiket'" class="px-10">
                        <div class="relative flex h-[150px] flex-col justify-between rounded-lg bg-[#b3b3b34a] px-4 py-3">
                            <div class="flex flex-col">
                                <p>#{{ $voluntrip->name }}a</p>
                                <p>{{ $voluntrip->total_ticket }} tiket tersedia</p>
                            </div>
                            <div class="garis w-full border border-dashed border-gray-500"></div>
                            <div class="flex items-center justify-between">
                                <p>Rp{{ number_format($voluntrip->ticket_price, 0, ',', '.') }}</p>
                                <button class="rounded-md bg-[#0060AF] px-4 text-white">Beli</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </section>
@endsection
