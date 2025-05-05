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
            <div
                class="grid gap-x-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg md:grid-cols-2 lg:grid-cols-4">
                @forelse($voluntrips as $voluntrip)
                    <div class="card-item flex max-h-fit flex-col overflow-hidden rounded-lg bg-white shadow-md">
                        <div class="thumbnail">
                            <img src="{{ Storage::url($voluntrip->thumbnail) }}" alt="thumbnail"
                                class="h-[200px] w-full">
                        </div>
                        <div class="card-body flex flex-col gap-2 px-3 pb-4 pt-3">
                            <p class="fundraiser text-[12px] font-thin">
                                {{ $voluntrip->fundraiser->user->hasRole('owner') ? 'By Owner' : $voluntrip->fundraiser->user->name }}
                            </p>
                            <h4 class="title-voluntrip font-bold">{{ $voluntrip->name }}</h4>
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
                            class="bg-indigo-700 py-1 text-center text-white">Lihat Detail</a>
                    </div>
                @empty
                    <p>
                        Belum Ada Data Saat Ini
                    </p>
                @endforelse
            </div>
        </div>

</x-app-layout>
