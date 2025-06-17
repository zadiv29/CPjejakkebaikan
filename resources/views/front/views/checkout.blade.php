@extends('front.layouts.app')
@section('title', 'Pembayaran')
@section('content')

    <body class="font-poppins bg-[#F6F9FC] text-[#292E4B]">
        <section class="mx-auto flex min-h-screen w-full max-w-[640px] flex-col overflow-x-hidden bg-[#FCF7F1]">
            <div class="header relative flex h-[220px] flex-col overflow-hidden">
                <nav class="relative z-20 flex items-center justify-between px-3 pt-5">
                    <div class="flex items-center gap-[10px]">
                        <a href="{{ route('front.index') }}" class="flex h-10 w-10 shrink-0">
                            <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
                        </a>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <p class="text-sm font-semibold">#SendSupport</p>
                    </div>
                    <a href="" class="flex h-10 w-10 shrink-0">
                        <img src="{{ asset('assets/images/icons/menu-dot.svg') }}" alt="icon">
                    </a>
                </nav>
                <div class="my-auto flex items-center gap-[14px] px-4">
                    <div class="relative flex h-[100px] w-[90px] shrink-0 overflow-hidden rounded-2xl">
                        <img src="{{ Storage::url($fundraising->thumbnail) }}" class="h-full w-full object-cover"
                            alt="thumbnail">
                        <p
                            class="absolute bottom-0 h-[23px] w-[90px] bg-[#4541FF] p-[4px_12px] text-center text-[10px] font-bold leading-[15px] text-white">
                            VERIFIED</p>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-bold">{{ $fundraising->name }}</p>
                        <p class="text-xs leading-[18px]">Target <span class="font-bold text-[#FF7815]">Rp
                                {{ number_format($fundraising->target_amount, 0, ',', '.') }}</span></p>
                    </div>
                </div>
            </div>
            <div class="z-30 flex flex-col">
                <div id="content"
                    class="flex h-full min-h-[calc(100vh-220px)] w-full flex-col gap-5 rounded-t-[40px] bg-white p-[30px_24px_30px]">
                    <form method="POST" action="{{ route('front.store', ['fundraising' => $fundraising->slug]) }}"
                        class="flex flex-col gap-5" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col gap-[10px]">
                            <p class="text-sm font-semibold">Donasi Anda</p>
                            <div
                                class="flex w-full items-center gap-[10px] rounded border border-gray-300 px-4 py-2 transition-all duration-300 focus-within:border-[#292E4B]">
                                <div class="flex h-6 w-6 shrink-0">
                                    <img src="{{ asset('assets/images/icons/dollar-circle.svg') }}" alt="icon">
                                </div>
                                <input type="text" id="amount" name="amount"
                                    class="w-full border-none bg-transparent focus:border-none focus:outline-none focus:ring-0"
                                    :value="old('amount')" required autofocus autocomplete="amount">
                            </div>
                        </div>
                        <hr class="border-dashed">
                        <div class="flex flex-col gap-[10px]">
                            <p class="text-sm font-semibold">Metode Pembayaran</p>
                            <div x-data="{ open: false, selected: '', label: 'Pilih Bank' }" class="relative">
                                <div
                                    class="flex w-full items-center justify-between rounded border border-gray-300 bg-white px-4 py-2 text-left shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <div class="flex items-center space-x-3">
                                        <x-fontisto-wallet class="w-4 text-blue-400" />
                                        <h1>Virtual Account</h1>
                                    </div>
                                    <!-- Trigger Button -->
                                    <button @click="open = !open" type="button"
                                        class="flex items-center justify-between rounded border border-gray-300 bg-white px-4 py-1 text-left shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <span x-text="label"></span>
                                        <svg class="ml-2 h-4 w-4 text-gray-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Dropdown Items -->
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1" @click.away="open = false"
                                    class="mt-1 w-full rounded border border-gray-300 bg-white shadow-lg">

                                    <ul class="grid grid-cols-2 gap-2 p-4 text-sm text-gray-700">
                                        <li @click="selected = 'BRI'; label = 'BRI';"
                                            :class="{ 'bg-blue-50 border-blue-500': selected === 'BRI' }"
                                            class="flex cursor-pointer items-center space-x-2 rounded-md border px-4 py-2 hover:bg-gray-100">
                                            <img src="{{ asset('assets/images/icons/briva.svg') }}" alt="briva"
                                                class="w-12" />
                                        </li>
                                        <li @click="selected = 'BNI'; label = 'BNI';"
                                            :class="{ 'bg-blue-50 border-blue-500': selected === 'BNI' }"
                                            class="cursor-pointer rounded-md border px-4 py-2 hover:bg-gray-100">
                                            <img src="{{ asset('assets/images/icons/bniva.svg') }}" alt="bniva"
                                                class="w-12" />
                                        </li>
                                    </ul>
                                </div>

                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="payment_channel" :value="selected">
                            </div>
                        </div>
                        <hr class="border-dashed">
                        <div class="flex flex-col gap-[10px]">
                            <p class="text-sm font-semibold">Masukkan Nama</p>
                            <div
                                class="flex w-full items-center rounded border border-gray-300 px-4 py-2 transition-all duration-300 focus-within:border-[#292E4B]">
                                <div class="mr-[10px] flex h-6 w-6 items-center justify-center overflow-hidden">
                                    <img src="{{ asset('assets/images/icons/user.svg') }}"
                                        class="h-full w-full object-contain" alt="icon">
                                </div>
                                <input type="text"
                                    class="w-full border-none font-semibold placeholder:font-normal placeholder:text-[#292E4B] focus:border-none focus:outline-none focus:ring-0"
                                    placeholder="Siapa Namamu?" name="name">
                            </div>
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <p class="text-sm font-semibold">Email</p>
                            <div
                                class="flex w-full items-center rounded border border-gray-300 px-4 py-2 transition-all duration-300 focus-within:border-[#292E4B]">
                                <div class="mr-[10px] flex h-6 w-6 items-center justify-center overflow-hidden">
                                    <img src="{{ asset('assets/images/icons/sms.svg') }}"
                                        class="h-full w-full object-contain" alt="icon">
                                </div>
                                <input type="text"
                                    class="w-full border-none font-semibold outline-none placeholder:font-normal placeholder:text-[#292E4B] focus:border-none focus:outline-none focus:ring-0"
                                    placeholder="Masukan Email Anda" name="email" id="email">
                            </div>
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <p class="text-sm font-semibold">Nomor Telepon</p>
                            <div
                                class="flex w-full items-center rounded border border-gray-300 px-4 py-2 transition-all duration-300 focus-within:border-[#292E4B]">
                                <div class="mr-[10px] flex h-6 w-6 items-center justify-center overflow-hidden">
                                    <img src="{{ asset('assets/images/icons/call.svg') }}"
                                        class="h-full w-full object-contain" alt="icon">
                                </div>
                                <input type="number"
                                    class="w-full border-none font-semibold outline-none placeholder:font-normal placeholder:text-[#292E4B] focus:border-none focus:outline-none focus:ring-0"
                                    placeholder="Tuliskan Nomor Telepon" name="phone_number">
                            </div>
                        </div>
                        <div class="flex flex-col gap-[10px]">
                            <p class="text-sm font-semibold">Pesan</p>
                            <div
                                class="flex w-full rounded border border-gray-300 px-4 py-2 transition-all duration-300 focus-within:border-[#292E4B]">
                                <div class="mr-[10px] mt-2 flex h-6 w-6 items-center justify-center overflow-hidden">
                                    <img src="{{ asset('assets/images/icons/sms.svg') }}"
                                        class="h-full w-full object-contain" alt="icon">
                                </div>
                                <textarea name="notes" id="notes"
                                    class="w-full border-none font-semibold outline-none placeholder:font-normal placeholder:text-[#292E4B] focus:border-none focus:outline-none focus:ring-0"
                                    cols="30" rows="4" placeholder="Berikan Pesan Untuk Mereka"></textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="mx-auto w-full text-nowrap rounded-full bg-[#76AE43] p-[14px_20px] text-center font-semibold text-white transition-all duration-300 hover:shadow-[0_12px_20px_0_#76AE4380]">Confirm
                            My Donation</button>
                    </form>
                </div>
            </div>

        </section>
    </body>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('amount');
        input.addEventListener('input', function() {
            let value = input.value.replace(/\D/g, '');
            input.value = new Intl.NumberFormat('id-ID').format(value);
        });
    });
</script>
