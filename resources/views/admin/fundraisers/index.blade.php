<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Fundraisers') }}
            </h2>
        </div>
    </x-slot>
    <div>

    </div>

    @role('owner')
        <div class="list-fundraisers py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col gap-y-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">


                    @forelse($fundraisers as $fundraiser)
                        <div class="item-card grid grid-cols-[30%_20%_auto_auto] items-center justify-between">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="{{ Storage::url($fundraiser->user->avatar) }}" alt=""
                                    class="h-[90px] w-[90px] rounded-2xl object-cover">
                                <div class="flex flex-col">
                                    <h3 class="line-clamp-2 text-xl font-bold text-indigo-950">{{ $fundraiser->user->name }}
                                    </h3>
                                </div>
                            </div>
                            <div class="hidden flex-col md:flex">
                                <p class="text-sm text-slate-500">Date</p>
                                <h3 class="text-xl font-bold text-indigo-950">{{ $fundraiser->created_at }}</h3>
                            </div>

                            @if ($fundraiser->is_active)
                                <span class="w-fit rounded-full bg-green-500 px-3 py-2 text-sm font-bold text-white">
                                    ACTIVE
                                </span>
                                <button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $fundraiser->id }}'); console.log('open modal event dispatched')"
                                    class="rounded-full bg-red-700 px-6 py-4 font-bold text-white">
                                    Hapus
                                </button>
                                <x-modal name="confirm-delete-{{ $fundraiser->id }}" focusable>
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900">Yakin ingin menghapus?</h2>
                                        <p class="mt-2 text-sm text-gray-600">Tindakan ini tidak dapat dibatalkan.</p>

                                        <div class="mt-6 flex justify-end space-x-2">
                                            <button x-on:click="$dispatch('close')"
                                                class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
                                                Batal
                                            </button>

                                            <form method="POST"
                                                action="{{ route('admin.fundraisers.destroy', $fundraiser->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </x-modal>
                            @else
                                <span class="w-fit rounded-full bg-orange-500 px-3 py-2 text-sm font-bold text-white">
                                    PENDING
                                </span>
                                <div class="hidden flex-row items-center gap-x-3 md:flex">
                                    <form action="{{ route('admin.fundraisers.update', $fundraiser) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                            Approve
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    @empty
                        <p>Belum ada apply</p>
                    @endforelse

                </div>
            </div>
        </div>
    @else
        <div class="list-fundraisers py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">
                    <div class="item-card flex flex-col items-center justify-between gap-y-5">
                        <div class="flex flex-row items-center gap-x-3">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M19 9C19 10.45 18.57 11.78 17.83 12.89C16.75 14.49 15.04 15.62 13.05 15.91C12.71 15.97 12.36 16 12 16C11.64 16 11.29 15.97 10.95 15.91C8.96 15.62 7.25 14.49 6.17 12.89C5.43 11.78 5 10.45 5 9C5 5.13 8.13 2 12 2C15.87 2 19 5.13 19 9Z"
                                    fill="#292D32" />
                                <path
                                    d="M21.2491 18.4699L19.5991 18.8599C19.2291 18.9499 18.9391 19.2299 18.8591 19.5999L18.5091 21.0699C18.3191 21.8699 17.2991 22.1099 16.7691 21.4799L11.9991 15.9999L7.2291 21.4899C6.6991 22.1199 5.6791 21.8799 5.4891 21.0799L5.1391 19.6099C5.0491 19.2399 4.7591 18.9499 4.3991 18.8699L2.7491 18.4799C1.9891 18.2999 1.7191 17.3499 2.2691 16.7999L6.1691 12.8999C7.2491 14.4999 8.9591 15.6299 10.9491 15.9199C11.2891 15.9799 11.6391 16.0099 11.9991 16.0099C12.3591 16.0099 12.7091 15.9799 13.0491 15.9199C15.0391 15.6299 16.7491 14.4999 17.8291 12.8999L21.7291 16.7999C22.2791 17.3399 22.0091 18.2899 21.2491 18.4699Z"
                                    fill="#292D32" />
                                <path
                                    d="M12.58 5.98L13.17 7.15999C13.25 7.31999 13.46 7.48 13.65 7.51L14.72 7.68999C15.4 7.79999 15.56 8.3 15.07 8.79L14.24 9.61998C14.1 9.75998 14.02 10.03 14.07 10.23L14.31 11.26C14.5 12.07 14.07 12.39 13.35 11.96L12.35 11.37C12.17 11.26 11.87 11.26 11.69 11.37L10.69 11.96C9.96997 12.38 9.53997 12.07 9.72997 11.26L9.96997 10.23C10.01 10.04 9.93997 9.75998 9.79997 9.61998L8.96997 8.79C8.47997 8.3 8.63997 7.80999 9.31997 7.68999L10.39 7.51C10.57 7.48 10.78 7.31999 10.86 7.15999L11.45 5.98C11.74 5.34 12.26 5.34 12.58 5.98Z"
                                    fill="#292D32" />
                            </svg>

                        </div>
                        <div class="flex flex-col text-center">
                            <h3 class="text-xl font-bold text-indigo-950">Buat Jejak Kebaikan</h3>
                            <p class="text-base text-slate-500">Jadilah bagian dari kami untuk membantu <br>mereka yang
                                membutuhkan bantuan kita</p>
                        </div>

                        @if ($fundraiserStatus == 'Pending')
                            <span class="w-fit rounded-full bg-orange-500 px-3 py-2 text-sm font-bold text-white">
                                PENDING
                            </span>
                        @elseif($fundraiserStatus == 'Active')
                            <a href="{{ route('admin.fundraisings.create') }}"
                                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                Create a Fundraising
                            </a>
                        @else
                            <form action="{{ route('admin.fundraiser.apply') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                    Become Fundraiser
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endrole
</x-app-layout>
