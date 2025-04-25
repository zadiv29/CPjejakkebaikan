<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Voluntrip') }}
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

                <form method="POST" action="{{ route('admin.voluntrip.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('thumbnail')" />
                        <x-text-input id="thumbnail" class="mt-1 block w-full" type="file" name="thumbnail" required
                            autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="target_amount" :value="__('Target Amount')" />
                        <x-text-input id="target_amount" class="mt-1 block w-full" type="number" name="target_amount"
                            :value="old('target_amount')" required autofocus autocomplete="target_amount" />
                        <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="ticket_price" :value="__('Ticket Price')" />
                        <x-text-input id="ticket_price" class="mt-1 block w-full" type="number" name="ticket_price"
                            :value="old('ticket_price')" required autofocus autocomplete="ticket_price" />
                        <x-input-error :messages="$errors->get('ticket_price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="w-full rounded-xl border border-slate-300"></textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        <x-text-input id="start_date" class="mt-1 block w-full" type="date" name="start_date"
                            required autofocus autocomplete="start_date" />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="start_time" :value="__('Starts At')" />
                        <x-text-input id="start_time" class="mt-1 block w-full" type="time" name="start_time"
                            required autofocus autocomplete="start_time" />
                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="end_time" :value="__('Ends At')" />
                        <x-text-input id="end_time" class="mt-1 block w-full" type="time" name="end_time" required
                            autofocus autocomplete="end_time" />
                        <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                    </div>

                    <div class="mt-4 flex items-center justify-end">

                        <button type="submit" class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                            Add New Voluntrip
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
