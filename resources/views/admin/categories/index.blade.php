<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-5 overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">

                @forelse($categories as $category)
                    <div class="item-card grid grid-cols-[40%_30%_auto] items-center justify-between">
                        <div class="flex flex-row gap-x-3">
                            <img src="{{ Storage::url($category->icon) }}" alt=""
                                class="h-[90px] w-[120px] rounded-2xl object-cover">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $category->name }}</h3>
                            </div>
                        </div>
                        <div class="hidden flex-col md:flex">
                            <p class="text-sm text-slate-500">Date</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $category->created_at }}</h3>
                        </div>
                        <div class="hidden flex-row items-center gap-x-3 md:flex">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-red-700 px-6 py-4 font-bold text-white">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum ada kategori terbaru.
                    </p>
                @endforelse


            </div>
        </div>
    </div>
</x-app-layout>
