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
                            <p class="text-[13px]">{{ $voluntrip->about }}</p>
                        </section>
                    </section>
                    {{-- #ANCHOR Tiket --}}
                    <section x-data="{ qty: 1, max: {{ $voluntrip->total_ticket }}, price: {{ $voluntrip->ticket_price }} }" x-show="tab === 'tiket'"
                        class="flex flex-col justify-between space-y-10 px-[24px] py-6">
                        <div
                            class="relative mx-auto flex h-auto w-full flex-col justify-between overflow-hidden rounded-xl shadow-lg">
                            <!-- Bagian atas -->
                            <div class="flex justify-between rounded-xl border border-b-0 border-gray-400 p-4">
                                <div class="flex flex-col gap-3">
                                    <h2 class="text-[14px] font-semibold text-black sm:text-base">
                                        {{ $voluntrip->name }}a
                                    </h2>
                                    <div class="flex items-center gap-1">
                                        <x-icon.ticket />
                                        <p class="text-sm text-gray-700" x-text="max + ' Tiket'"></p>
                                    </div>
                                </div>
                                <div class="-mr-3 h-6 w-6 rounded-full border border-gray-300 bg-white shadow-md"></div>
                            </div>

                            <!-- Garis putus-putus -->
                            <div class="relative z-10">
                                <div
                                    class="absolute left-0 top-1/2 -ml-3 h-6 w-6 -translate-y-1/2 rounded-full border border-gray-400 bg-white shadow-md">
                                </div>
                                <hr class="border-1 border-t border-dashed border-black" />
                                <div
                                    class="absolute right-0 top-1/2 -mr-3 h-6 w-6 -translate-y-1/2 rounded-full border border-gray-400 bg-white shadow-md">
                                </div>
                            </div>

                            <!-- Bagian bawah -->
                            <div
                                class="relative z-0 flex items-center justify-between rounded-xl border border-t-0 border-gray-400 bg-white p-4">
                                <p class="text-[14px] font-bold text-black sm:text-lg"
                                    x-text="'Rp' + (qty * price).toLocaleString('id-ID')"></p>
                                <div class="flex items-center">
                                    <button @click="qty = Math.max(1, qty - 1)">
                                        <x-icon.minus />
                                    </button>
                                    <input type="text" x-model="qty" class="w-14 border-none text-center" readonly
                                        disabled />
                                    <button @click="if(qty < max) qty++"><x-icon.plus /></button>
                                </div>
                            </div>

                            <!-- Tombol Beli -->
                        </div>
                        <a :href="`{{ route('volunteers.create', ['voluntrip' => $voluntrip->slug]) }}?qty=${qty}&total=${qty * price}`"
                            class="block w-full rounded-md bg-[#0060AF] py-2 text-center text-white transition hover:bg-blue-700"
                            x-text="'Beli ' + qty + ' Tiket'">
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
