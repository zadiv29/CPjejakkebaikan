@extends('front.layouts.app')

@section('title', 'Pendaftaran Volunteer')

@section('content')
    <section class="mx-auto flex max-w-xl flex-col gap-8 bg-white px-4 py-6">
        <section class="flex flex-col gap-3">
            <h1 class="text-lg font-semibold">Detail Acara</h1>
            <div class="flex h-[170px] gap-4 rounded-xl border border-gray-400 p-4 shadow-md">
                <img src="{{ Storage::url($voluntrip->thumbnail) }}" class="w-auto rounded-md" alt="thumbnail">
                <div class="flex h-full flex-col gap-3">
                    <h2 class="line-clamp-2 text-sm sm:text-base">{{ $voluntrip->name }}</h2>
                    <div class="space-y-1">
                        <span class="flex items-start gap-2 text-[12px] font-normal"><x-icon.date />
                            {{ $date }}</span>
                        <span class="flex items-start gap-2 text-[12px] font-normal"><x-icon.time />{{ $timeStart }}
                            -
                            {{ $timeEnd }}</span>
                        <span class="flex items-start gap-2 text-[12px] font-normal"><x-icon.location /> Jalan Tluki,
                            Condong Catur
                            Yogyakarta</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="flex flex-col justify-between gap-3">
            <h1 class="text-lg font-semibold">Detail Tiket</h1>
            <div class="relative mx-auto flex h-auto w-full flex-col justify-between overflow-hidden rounded-xl shadow-md">
                <!-- Bagian atas -->
                <div class="flex justify-between rounded-xl border border-b-0 border-gray-400 p-4">
                    <div class="flex flex-col gap-3">
                        <h2 class="text-[14px] font-semibold text-black sm:text-base">
                            {{ $voluntrip->name }}
                        </h2>
                        {{-- <p>{{ $voluntrip-> }}</p> --}}
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
                    <p class="text-sm sm:text-base">Total Pembayaran
                        <br><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                    </p>
                    <div class="">
                        <p class="text-sm sm:text-base">Jumlah tiket</p>
                        <div class="flex items-center justify-end gap-1">
                            <p class="text-sm text-gray-700 sm:text-base">{{ $qty }}</p>
                            <x-icon.ticket />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <form x-data="{ isSubmitting: false }" @submit.prevent="if (!isSubmitting) { isSubmitting = true; $el.submit(); }"
            action="{{ route('volunteers.store') }}" method="POST">
            @csrf

            <section class="flex flex-col gap-3">
                <h1 class="text-lg font-semibold">Detail Pemesan</h1>
                <div x-data="{ qty: {{ $qty }} }" class="flex flex-col gap-8">
                    <!-- //SECTION Detail Pemesan -->
                    <template x-for="index in qty" :key="index">
                        <div class="rounded border bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <h3 class="mb-2 font-semibold">Data Volunteer
                                    <span x-text="index"></span>
                                </h3>
                                <p x-show="index === 1" x-data="{ show: false }" @mouseenter="show = true"
                                    @mouseleave="show = false" @click="show = !show"
                                    class="relative inline-block cursor-pointer rounded-full bg-green-500 px-2 pb-[2px] text-sm text-white">
                                    Penanggung Jawab

                                    <!-- Tooltip -->
                                    <span x-show="show" x-transition
                                        class="absolute left-1/2 top-full z-10 mt-2 w-[200px] -translate-x-1/2 rounded-md bg-black px-3 py-2 text-xs text-white shadow-lg"
                                        @click.outside="show = false">
                                        Penanggung jawab akan menerima email verifikasi dan bertanggung jawab atas proses
                                        pembayaran.
                                    </span>
                                </p>
                            </div>

                            <div class="mb-2">
                                <label class="block">Nama</label>
                                <input type="text" :name="`volunteers[${index - 1}][name]`"
                                    class="w-full rounded border px-2 py-1" required />
                            </div>

                            <div class="mb-2">
                                <label class="block">Email</label>
                                <input type="email" :name="`volunteers[${index - 1}][email]`"
                                    class="w-full rounded border px-2 py-1" required />
                            </div>

                            <div class="mb-2">
                                <label class="block">Nomor HP</label>
                                <input type="text" :name="`volunteers[${index - 1}][number_phone]`"
                                    class="w-full rounded border px-2 py-1" required />
                            </div>
                        </div>
                    </template>

                    <!-- //SECTION MEtode Pembayaran -->
                    <div x-data="{ open: false, selected: '', label: 'Pilih Bank' }" class="relative">
                        <label class="mb-1 block font-medium">Metode Pembayaran</label>
                        <div
                            class="flex w-full items-center justify-between rounded border border-gray-300 bg-white px-4 py-2 text-left shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <h1>Virtual Account</h1>
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
                                <li @click="selected = 'BRI'; label = 'BRI'; open = false"
                                    class="cursor-pointer rounded-md border px-4 py-2 hover:bg-gray-100">BRI</li>
                                <li @click="selected = 'BCA'; label = 'BCA'; open = false"
                                    class="cursor-pointer rounded-md border px-4 py-2 hover:bg-gray-100">BCA</li>
                                <li @click="selected = 'Mandiri'; label = 'Mandiri'; open = false"
                                    class="cursor-pointer rounded-md border px-4 py-2 hover:bg-gray-100">Mandiri</li>
                                <li @click="selected = 'BNI'; label = 'BNI'; open = false"
                                    class="cursor-pointer rounded-md border px-4 py-2 hover:bg-gray-100">BNI</li>
                            </ul>
                        </div>

                        <!-- Hidden input for form submission -->
                        <input type="hidden" name="payment_channel" :value="selected">
                    </div>



                    <input type="hidden" name="voluntrip_id" value="{{ $voluntrip->id }}">

                    <div class="mt-4">
                        <button type="submit" :disabled="isSubmitting"
                            class="w-full rounded bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700 disabled:bg-gray-400">
                            <span x-show="!isSubmitting">Daftar dan Buat Pembayaran</span>
                            <span x-show="isSubmitting">Memproses...</span>
                        </button>
                    </div>
                </div>
            </section>

        </form>
    </section>

    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
