<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Voluntrip') }}
            </h2>
            <a href="{{ route('admin.voluntrip.create') }}"
                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">
                @forelse($voluntrips as $voluntrip)
                    {{-- <div class="item-card flex flex-col justify-between gap-y-10 md:flex-row md:items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($voluntrip->thumbnail) }}" alt=""
                                class="h-[90px] w-[120px] rounded-2xl object-cover">
                            <div class="flex flex-col text-wrap bg-slate-400">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $voluntrip->name }}</h3>
                                <p class="w-full text-clip text-sm text-slate-500">{{ $voluntrip->about }}</p>
                            </div>
                        </div>
                        <div class="hidden flex-col md:flex">
                            <p class="text-sm text-slate-500">Fundraiser</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $voluntrip->fundraiser->user->name }}
                            </h3>
                        </div>
                        <div class="hidden flex-row items-center gap-x-3 md:flex">
                            <a href="{{ route('admin.voluntrips.show', $voluntrip) }}"
                                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                View Details
                            </a>
                        </div>
                    </div> --}}
                    <div
                        class="card-item flex max-h-fit max-w-[300px] flex-col overflow-hidden rounded-lg bg-white shadow-md">
                        <div class="thumbnail">
                            <img src="{{ Storage::url($voluntrip->thumbnail) }}" alt="thumbnail"
                                class="h-[200px] w-full">
                        </div>
                        <div class="card-body flex flex-col gap-2 px-3 pb-4 pt-3">
                            <p class="fundraiser text-[12px ] font-thin">{{ $voluntrip->fundraiser->user->name }}</p>
                            <h4 class="title-voluntrip font-bold">{{ $voluntrip->name }}</h4>
                            <div class="donation-section flex flex-col gap-2">
                                <div class="flex items-center gap-2">
                                    <p class="text-[13px] font-thin">Funded</p>
                                    <p class="text-[15px] font-medium">Rp2.000.000</p>
                                </div>
                                <div class="h-2.5 w-full rounded-full bg-slate-300">
                                    <div class="h-2.5 rounded-full bg-indigo-600" style="width: 10%">
                                    </div>
                                </div>
                            </div>
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
