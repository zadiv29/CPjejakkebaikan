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
            <div class="flex flex-wrap-reverse items-start justify-between gap-5">
                <h1 class="text-3xl font-bold text-gray-800">{{ $voluntrip->name }}</h1>
                @role('owner')
                    @if (!$voluntrip->is_active)
                        <form action="{{ route('admin.voluntrip.update', $voluntrip) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="rounded-full bg-indigo-700 px-4 py-1 font-bold text-white">
                                Approve Now
                            </button>
                        </form>
                    @endif
                @endrole
            </div>

            <!-- Layout -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Gambar -->
                <div>
                    <img src="{{ asset('storage/' . $voluntrip->thumbnail) }}" alt="Thumbnail"
                        class="w-full rounded-lg object-cover shadow">
                </div>

                <form action="{{ route('admin.voluntrip.update', $voluntrip->id) }}" method="POST"
                    id="update-voluntrip-{{ $voluntrip['id'] }}" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
                <!-- Detail -->
                <div class="relative space-y-3 rounded-md border p-2 pb-14 text-sm text-gray-700"
                    x-data="{ isEdit: false, dateValue: '{{ $dateForInput }}', timeStart: '{{ $timeStartInput }}', timeEnd: '{{ $timeEndInput }}' }">
                    <div class="relative grid grid-cols-[30%_auto] items-center rounded-md border">
                        <span class="cursor-default p-3">Fundraiser</span>
                        <p class="bg-gray-100 p-3">{{ $voluntrip->fundraiser->user->name ?? '-' }}</p>
                        <span class="cursor-default p-3">Tanggal Mulai</span>
                        <div class="relative h-full">
                            <span x-show="!isEdit" x-transition
                                class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 p-3 text-gray-700">
                                {{ $date }}
                            </span>

                            <input x-show="isEdit" x-transition type="date" x-model="dateValue"
                                class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white ring-2 ring-inset transition-all duration-300 ease-in-out focus:ring-2 focus:ring-inset"
                                name="start_date" form="update-voluntrip-{{ $voluntrip['id'] }}">
                        </div>
                        <span class="cursor-default p-3">Waktu Mulai</span>
                        <div class="relative h-full">
                            <span x-show="!isEdit" x-transition
                                class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 px-3 capitalize text-gray-700">
                                {{ $timeStart }}
                            </span>

                            <!-- Input jam -->
                            <input x-show="isEdit" x-transition type="time" x-model="timeStart"
                                class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white capitalize ring-2 ring-inset focus:ring-2 focus:ring-inset"
                                name="start_time" form="update-voluntrip-{{ $voluntrip->id }}"
                                form="update-voluntrip-{{ $voluntrip['id'] }}">
                        </div>
                        <span class="cursor-default p-3">Waktu Selesai</span>
                        <div class="relative h-full">
                            <span x-show="!isEdit" x-transition
                                class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 px-3 capitalize text-gray-700">
                                {{ $timeEnd }}
                            </span>

                            <!-- Input jam -->
                            <input x-show="isEdit" x-transition type="time" x-model="timeEnd"
                                class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white capitalize ring-2 ring-inset focus:ring-2 focus:ring-inset"
                                name="end_time" form="update-voluntrip-{{ $voluntrip->id }}">
                        </div>
                        <span class="cursor-default p-3">Harga Tiket</span>
                        <div class="relative h-full">
                            <span x-show="!isEdit" x-transition
                                class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 px-3 capitalize text-gray-700">
                                Rp{{ number_format($voluntrip->ticket_price, 0, ',', '.') }}
                            </span>
                            <input x-show="isEdit" x-transition x-model="'{{ $voluntrip['ticket_price'] }}'"
                                class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white capitalize ring-2 ring-inset focus:ring-2 focus:ring-inset"
                                name="ticket_price" form="update-voluntrip-{{ $voluntrip->id }}">
                        </div>
                        <span class="cursor-default p-3">Total Tiket</span>
                        <div class="relative h-full">
                            <span x-show="!isEdit" x-transition
                                class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 px-3 capitalize text-gray-700">
                                {{ $voluntrip['total_ticket'] }}
                            </span>
                            <input x-show="isEdit" x-transition x-model="'{{ $voluntrip['total_ticket'] }}'"
                                class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white capitalize ring-2 ring-inset focus:ring-2 focus:ring-inset"
                                name="total_ticket" form="update-voluntrip-{{ $voluntrip['id'] }}">
                        </div>
                        <span class="cursor-default p-3">Status Event</span>
                        <div class="relative h-full">
                            @role('fundraiser')
                                @if ($voluntrip->is_active)
                                    <p x-show="!isEdit" x-transition
                                        class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 px-3 capitalize text-gray-700">
                                        <span
                                            class="{{ $voluntrip->event_status === 'active' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-600' }} rounded-md px-3">
                                            {{ $voluntrip['event_status'] === 'active' ? 'aktif' : 'selesai' }}
                                        </span>
                                    </p>
                                    <select x-show="isEdit" x-transition name="event_status" id="event_status"
                                        form="update-voluntrip-{{ $voluntrip->id }}"
                                        class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white capitalize ring-2 ring-inset transition-all duration-300 ease-in-out focus:ring-2 focus:ring-inset">
                                        <option disabled value="">-- Pilih Status --</option>
                                        <option value="active"
                                            {{ $voluntrip->event_status === 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="completed"
                                            {{ $voluntrip->event_status === 'completed' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                @else
                                    <p
                                        class="absolute left-0 top-0 flex h-full w-full cursor-not-allowed items-center bg-gray-100 px-3 capitalize text-gray-700">
                                        <span class="rounded-md bg-red-100 px-2 text-red-800">
                                            Menunggu persetujuan admin
                                        </span>
                                    </p>
                                @endif
                                @elserole('owner')
                                @php
                                    $isOwnerOfEvent = $voluntrip->fundraiser?->user_id === auth()->id();
                                @endphp
                                @if ($isOwnerOfEvent && $voluntrip->is_active)
                                    <div x-show="!isEdit"
                                        class="absolute left-0 top-0 flex h-full w-full items-center rounded-md bg-gray-100 px-2 py-1 text-sm">
                                        <span
                                            class="{{ $voluntrip->event_status === 'active' ? 'bg-green-100 text-green-800' : ($voluntrip->event_status === 'completed' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-800') }} px-3 capitalize">
                                            {{ $voluntrip['event_status'] === 'active' ? 'aktif' : 'selesai' }}
                                        </span>
                                    </div>
                                    <select x-show="isEdit" x-transition name="event_status"
                                        form="update-voluntrip-{{ $voluntrip->id }}"
                                        class="absolute left-0 top-0 h-full w-full cursor-text border-0 bg-white capitalize ring-2 ring-inset transition-all duration-300 ease-in-out focus:ring-2 focus:ring-inset">
                                        <option disabled value="">-- Pilih Status --</option>
                                        <option value="active"
                                            {{ $voluntrip->event_status === 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="completed"
                                            {{ $voluntrip->event_status === 'completed' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                @elseif($voluntrip->is_active)
                                    <p
                                        class="absolute left-0 top-0 flex h-full w-full items-center rounded-md bg-gray-100 px-2 py-1 text-sm">
                                        <span
                                            class="{{ $voluntrip->event_status === 'active' ? 'bg-green-100 text-green-800' : ($voluntrip->event_status === 'completed' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-800') }} px-3 capitalize">
                                            {{ $voluntrip['event_status'] === 'active' ? 'aktif' : 'selesai' }}
                                        </span>
                                    </p>
                                @else
                                    <p
                                        class="absolute left-0 top-0 flex h-full w-full items-center rounded-md bg-gray-100 px-2 py-1 text-sm">
                                        <span
                                            class="{{ $voluntrip->event_status === 'active' ? 'bg-green-100 text-green-800' : ($voluntrip->event_status === 'completed' ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-800') }} px-3 capitalize">
                                            {{ $voluntrip['event_status'] }}
                                        </span>
                                    </p>
                                @endif
                            @endrole

                        </div>
                    </div>

                    <div class="absolute bottom-2 right-2 flex items-center gap-2">
                        <button class="rounded-md border bg-blue-400 px-5 py-[2px] text-white"
                            @click="isEdit = !isEdit">
                            Edit
                        </button>
                        <button type="submit" id="update-voluntrip" form="update-voluntrip-{{ $voluntrip['id'] }}"
                            :disabled="!isEdit"
                            :class="{
                                'rounded bg-green-500 px-5 py-[2px] text-white transition-all duration-300 ease-in-out': isEdit,
                                'rounded bg-gray-400 cursor-default px-5 py-[2px] text-white transition-all duration-300 ease-in-out':
                                    !isEdit
                            }">
                            Simpan
                        </button>
                        @role('owner')
                            <button class="rounded-md border bg-red-400 px-5 py-[2px] text-white">
                                Delete
                            </button>
                        @endrole
                    </div>
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
