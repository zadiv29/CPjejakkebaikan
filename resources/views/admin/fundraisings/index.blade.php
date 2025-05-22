<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Fundraisings') }}
            </h2>
            <a href="{{ route('admin.fundraisings.create') }}"
                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">

                @forelse($fundraisings as $fundraising)
                    <div
                        class="item-card flex flex-col justify-between gap-y-10 md:grid md:grid-cols-[35%_15%_10%_25%_auto] md:items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($fundraising->thumbnail) }}" alt=""
                                class="h-[90px] w-[120px] rounded-2xl object-cover">
                            <div class="flex flex-col">
                                <h3 class="line-clamp-2 text-xl font-bold text-indigo-950">{{ $fundraising->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $fundraising->category->name }}</p>
                            </div>
                        </div>
                        <div class="hidden flex-col md:flex">
                            <p class="text-sm text-slate-500">Target Amount</p>
                            <h3 class="text-xl font-bold text-indigo-950">Rp
                                {{ number_format($fundraising->target_amount, 0, ',', '.') }}</h3>
                        </div>
                        <div class="hidden flex-col md:flex">
                            <p class="text-sm text-slate-500">Donaturs</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $fundraising->donaturs->count() }}</h3>
                        </div>
                        <div class="hidden flex-col md:flex">
                            <p class="text-sm text-slate-500">Fundraiser</p>
                            <h3 class="line-clamp-2 text-xl font-bold text-indigo-950">
                                {{ $fundraising->fundraiser->user->name }}
                            </h3>
                        </div>
                        <div class="hidden flex-row items-center gap-x-3 md:flex">
                            <a href="{{ route('admin.fundraisings.show', $fundraising) }}"
                                class="rounded-full bg-indigo-700 px-6 py-4 text-sm font-bold text-white">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum Ada Data Saat Ini
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
