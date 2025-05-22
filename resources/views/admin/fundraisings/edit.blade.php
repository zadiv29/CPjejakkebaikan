<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Fundraising') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-10 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="w-full rounded-3xl bg-red-500 py-3 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('admin.fundraisings.update', $fundraising) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            value="{{ $fundraising->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <img src="{{ Storage::url($fundraising->thumbnail) }}" alt=""
                            class="h-[90px] w-[120px] rounded-2xl object-cover">
                        <x-text-input id="thumbnail" class="mt-1 block w-full" type="file" name="thumbnail" autofocus
                            autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="target_amount" :value="__('target_amount')" />
                        <x-text-input id="target_amount" class="mt-1 block w-full" type="text" name="target_amount"
                            value="{{ number_format($fundraising->target_amount, 0, ',', '.') }}" required autofocus
                            autocomplete="target_amount" />
                        <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('category')" />

                        <select name="category_id" id="category_id"
                            class="w-full rounded-lg border border-slate-300 py-3 pl-3">
                            <option value="">Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $fundraising->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="w-full rounded-xl border border-slate-300">{{ $fundraising->about }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4 flex items-center justify-end">

                        <button type="submit" class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                            Update Fundraising
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('target_amount');
        input.addEventListener('input', function() {
            let value = input.value.replace(/\D/g, '');
            input.value = new Intl.NumberFormat('id-ID').format(value);
        });
    });
</script>
