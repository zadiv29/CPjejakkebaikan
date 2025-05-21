<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Voluntrip') }}
            </h2>
            @role('fundraiser|owner')
                <a href="{{ route('admin.voluntrip.create') }}"
                    class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                    Add New
                </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid gap-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg md:grid-cols-2 lg:grid-cols-4">
                @forelse($voluntrips as $voluntrip)
                    <div
                        class="card-item relative flex max-h-[500px] flex-col overflow-hidden rounded-lg bg-white shadow-md">
                        <div class="label absolute right-2 top-2 flex gap-1">
                            <span
                                class="{{ $voluntrip->event_status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-600'
                                    : ($voluntrip->event_status === 'active'
                                        ? 'text-green-600 bg-green-100'
                                        : ($voluntrip->event_status === 'rejected'
                                            ? 'bg-red-100 text-red-600'
                                            : 'bg-blue-100 text-blue-600')) }} rounded-sm px-2 text-[12px] font-medium capitalize">{{ $voluntrip->event_status }}</span>
                        </div>
                        <div class="thumbnail">
                            <img src="{{ Storage::url($voluntrip->thumbnail) }}" alt="thumbnail"
                                class="h-[200px] w-full">
                        </div>
                        <div class="card-body flex h-full flex-col justify-between gap-4 px-3 pb-4 pt-3">
                            <div>
                                <p class="fundraiser text-[12px] font-thin">
                                    {{ $voluntrip->fundraiser->user->hasRole('owner') ? 'By Owner' : $voluntrip->fundraiser->user->name }}
                                </p>
                                <h4 class="title-voluntrip line-clamp-2 font-bold">{{ $voluntrip->name }}</h4>
                                <div class="donation-section flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-[13px] font-thin">Funded</p>
                                        <p class="text-[15px] font-medium">
                                            Rp{{ number_format($voluntrip->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="h-2.5 w-full rounded-full bg-slate-300">
                                        <div class="h-2.5 rounded-full bg-indigo-600" style="width: 10%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.voluntrip.show', $voluntrip->slug) }}"
                                class="rounded-md bg-indigo-700 py-1 text-center text-white">Lihat Detail</a>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum Ada Data Saat Ini
                    </p>
                @endforelse
            </div>
        </div>

</x-app-layout>
