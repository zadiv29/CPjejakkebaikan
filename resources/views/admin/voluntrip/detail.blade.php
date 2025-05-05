<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Voluntrip Detail') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-5xl space-y-6 rounded-xl bg-white p-6 shadow-md">
            <!-- Header -->
            <div class="flex">
                <h1 class="text-3xl font-bold text-gray-800">{{ $voluntrip->name }}</h1>
            </div>

            <!-- Layout -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Gambar -->
                <div>
                    <img src="{{ asset('storage/' . $voluntrip->thumbnail) }}" alt="Thumbnail"
                        class="w-full rounded-lg object-cover shadow">
                </div>

                <!-- Detail -->
                <div class="relative space-y-3 rounded-md border p-2 text-sm text-gray-700">
                    <div class="flex">
                        <span class="w-40 font-medium">Fundraiser</span>
                        <span>: {{ $voluntrip->fundraiser->user->name ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-medium">Tanggal Mulai</span>
                        <span>: {{ $date }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-medium">Waktu</span>
                        <span>: {{ $timeStart }} - {{ $timeEnd }} WIB</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-medium">Harga Tiket</span>
                        <span>: Rp{{ number_format($voluntrip->ticket_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-40 font-medium">Total Tiket</span>
                        <span>: {{ $voluntrip->total_ticket }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-40 font-medium">Status Event</span>
                        <div class="flex items-center gap-1">
                            <span>:</span>

                            @role('fundraiser')
                                @if ($voluntrip->is_active)
                                    <form action="{{ route('admin.voluntrip.update', $voluntrip->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH') {{-- karena kita update --}}

                                        <div class="flex items-center gap-2">
                                            <select name="event_status" id="event_status" onchange="this.form.submit()"
                                                class="rounded-md border border-gray-300 px-2 py-1 text-sm">
                                                <option disabled selected>-- Pilih Status --</option>
                                                <option value="active"
                                                    {{ $voluntrip->event_status === 'active' ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="completed"
                                                    {{ $voluntrip->event_status === 'completed' ? 'selected' : '' }}>
                                                    Selesai</option>
                                            </select>
                                        </div>
                                    </form>
                                @else
                                    <span class="rounded-md bg-red-100 px-2 py-1 text-sm text-red-800">Menunggu persetujuan
                                        admin</span>
                                @endif
                                @elserole('owner')
                                {{-- Admin hanya bisa melihat status --}}
                                <span
                                    class="{{ $voluntrip->event_status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} rounded-md px-2 py-1 text-sm">
                                    {{ ucfirst($voluntrip->event_status) }}
                                </span>
                            @endrole
                        </div>

                    </div>
                    @role('owner')
                        @if (!$voluntrip->is_active)
                            <form action="{{ route('admin.voluntrip.update', $voluntrip) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="approve">
                                <button type="submit"
                                    class="absolute bottom-2 right-2 rounded-full bg-indigo-700 px-4 py-1 font-bold text-white">
                                    Approve Now
                                </button>
                            </form>
                        @endif
                    @endrole
                </div>


            </div>

            <!-- Tentang Event -->
            <div class="break-words border-t pt-4">
                <h2 class="mb-2 text-lg font-semibold text-gray-800">Tentang Event</h2>
                <p class="text-justify leading-relaxed text-gray-600">{{ $voluntrip->about }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
