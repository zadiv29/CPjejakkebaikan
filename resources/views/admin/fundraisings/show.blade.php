<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Fundraising Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">

                @if ($fundraising->is_active)
                    <span class="w-fit rounded-2xl bg-green-500 p-5 font-bold text-white">
                        Donasi ini sudah disetujui dan dapat menerima dana
                    </span>
                @else
                    <div class="flex flex-row justify-between">
                        <span class="w-fit rounded-2xl bg-red-500 p-5 font-bold text-white">
                            Donasi ini belum disetujui admin
                        </span>
                        @role('owner')
                            <form action="{{ route('admin.fundraising_withdrawals.activate_fundraising', $fundraising) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                    Approve Now
                                </button>
                            </form>
                        @endrole
                    </div>
                @endif

                <hr>


                <div class="item-card grid grid-cols-[60%_auto_auto] items-center justify-between gap-y-10">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($fundraising->thumbnail) }}" alt=""
                            class="h-[150px] w-[200px] rounded-2xl object-cover">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $fundraising->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $fundraising->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm text-slate-500">Donaturs</p>
                        <h3 class="text-xl font-bold text-indigo-950">{{ $fundraising->donaturs->count() }}</h3>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        @role('fundraiser')
                            <a href="{{ route('admin.fundraisings.edit', $fundraising) }}"
                                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                Edit
                            </a>
                        @endrole
                        <form action="{{ route('admin.fundraisings.destroy', $fundraising) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-red-700 px-6 py-4 font-bold text-white">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-row items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-indigo-950">Rp
                            {{ number_format($totalDonations, 0, ',', '.') }}</h3>
                        <p class="text-sm text-slate-500">Funded</p>
                    </div>
                    <div class="h-2.5 w-[400px] rounded-full bg-slate-300">
                        <div class="h-2.5 rounded-full bg-indigo-600" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-indigo-950">Rp
                            {{ number_format($fundraising->target_amount, 0, ',', '.') }}</h3>
                        <p class="text-sm text-slate-500">Goal</p>
                    </div>
                </div>
                <hr class="my-5">
                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-indigo-950">Deskripsi</h3>
                        <p>{{ $fundraising->about }}</p>
                    </div>
                </div>
                <hr class="my-5">

                @role('fundraiser')
                    @if (!$hasRequestedWithdrawal)
                        <h3 class="text-2xl font-bold text-indigo-950">Withdraw Donations</h3>

                        <form method="POST" action="{{ route('admin.fundraising_withdrawals.store', $fundraising) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="bank_name" :value="__('bank_name')" />
                                <x-text-input id="bank_name" class="mt-1 block w-full" type="text" name="bank_name"
                                    :value="old('bank_name')" required autofocus autocomplete="bank_name" />
                                <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="bank_account_name" :value="__('bank_account_name')" />
                                <x-text-input id="bank_account_name" class="mt-1 block w-full" type="text"
                                    name="bank_account_name" :value="old('bank_account_name')" required autofocus
                                    autocomplete="bank_account_name" />
                                <x-input-error :messages="$errors->get('bank_account_name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="bank_account_number" :value="__('bank_account_number')" />
                                <x-text-input id="bank_account_number" class="mt-1 block w-full" type="text"
                                    name="bank_account_number" :value="old('bank_account_number')" required autofocus
                                    autocomplete="bank_account_number" />
                                <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2" />
                            </div>

                            <div class="mt-4 flex items-center justify-end">

                                <button type="submit" class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                    Request Withdraw
                                </button>
                            </div>
                        </form>
                    @endif

                    <hr class="my-5">
                @endrole

                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-indigo-950">Donaturs</h3>
                    </div>
                </div>

                @forelse($fundraising->donaturs as $donatur)
                    <div class="item-card flex flex-row items-center justify-between gap-y-10">
                        <div class="flex flex-row items-center gap-x-3">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">Rp
                                    {{ number_format($donatur->total_amount, 0, ',', '.') }}</h3>
                                <p class="text-sm text-slate-500">{{ $donatur->name }}</p>
                            </div>
                        </div>

                        <p class="text-sm text-slate-500">{{ $donatur->notes }}</p>

                    </div>
                @empty
                    <p>
                        Belum Ada Yang Berdonasi
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
