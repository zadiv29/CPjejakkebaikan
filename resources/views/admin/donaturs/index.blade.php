<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Donaturs') }}
            </h2>
        </div>
    </x-slot>
    <div>

    </div>
    <div class="list-donaturs py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">

                @forelse($donaturs as $donatur)
                    <div class="item-card grid grid-cols-[40%_30%_auto_auto] items-center justify-between">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($donatur->fundraising->thumbnail) }}" alt=""
                                class="h-[90px] w-[90px] rounded-2xl object-cover">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $donatur->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $donatur->created_at }}</p>
                            </div>
                        </div>
                        <div class="hidden flex-col md:flex">
                            <p class="text-sm text-slate-500">Amount</p>
                            <h3 class="text-xl font-bold text-indigo-950">Rp
                                {{ number_format($donatur->total_amount, 0, ',', '.') }}</h3>
                        </div>
                        @if ($donatur->is_paid)
                            <span class="w-fit rounded-full bg-green-500 px-3 py-2 text-sm font-bold text-white">
                                PAID
                            </span>
                        @else
                            <span class="w-fit rounded-full bg-orange-500 px-3 py-2 text-sm font-bold text-white">
                                PENDING
                            </span>
                        @endif
                        <div class="hidden flex-row items-center gap-x-3 md:flex">
                            <a href="{{ route('admin.donaturs.show', $donatur) }}"
                                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum Ada Donatur
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
