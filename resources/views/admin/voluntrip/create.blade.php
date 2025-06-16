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
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        {{-- <x-text-input id="start_date" class="mt-1 block w-full" type="date" name="start_date"
                            required autofocus autocomplete="start_date" :value="old('start_date')" />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" /> --}}
                        <div class="grid grid-cols-3 gap-4">
                            {{-- Dropdown untuk Tanggal (Hari) --}}
                            <select id="start_date_day" name="start_date_day"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">DD</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('start_date_day') == $i ? 'selected' : '' }}>
                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('start_date_day')" class="mt-2" />

                            {{-- Dropdown untuk Bulan --}}
                            <select id="start_date_month" name="start_date_month"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">MM</option>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}"
                                        {{ old('start_date_month') == $month ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        {{-- Menampilkan nama bulan --}}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('start_date_month')" class="mt-2" />

                            {{-- Dropdown untuk Tahun --}}
                            <select id="start_date_year" name="start_date_year"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">YYYY</option>
                                {{-- Ubah start loop menjadi tahun yang lebih lampau, contohnya 1950 --}}
                                @for ($i = 1950; $i <= date('Y') + 10; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('start_date_year') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('start_date_year')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="start_time" :value="__('Starts At')" />
                        <x-text-input id="start_time" class="mt-1 block w-full" type="time" name="start_time"
                            required autofocus autocomplete="start_time" :value="old('start_time')" />
                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="end_time" :value="__('Ends At')" />
                        <x-text-input id="end_time" class="mt-1 block w-full" type="time" name="end_time" required
                            autofocus autocomplete="end_time" :value="old('end_time')" />
                        <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="total_ticket" :value="__('Total Tickets')" />
                        <x-text-input id="total_ticket" class="mt-1 block w-full" type="number" name="total_ticket"
                            required autofocus autocomplete="total_ticket" :value="old('total_ticket')" />
                        <x-input-error :messages="$errors->get('total_ticket')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="w-full rounded-xl border border-slate-300"></textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="ticket_price" :value="__('Ticket Price')" />
                        <x-text-input id="ticket_price" class="mt-1 block w-full" type="text" name="ticket_price"
                            :value="old('ticket_price')" required autofocus autocomplete="ticket_price" />
                        <x-input-error :messages="$errors->get('ticket_price')" class="mt-2" />
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="rounded-full bg-indigo-700 px-6 py-4 font-bold text-white">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('ticket_price');
        input.addEventListener('input', function() {
            let value = input.value.replace(/\D/g, '');
            input.value = new Intl.NumberFormat('id-ID').format(value);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const currentDay = today.getDate();
        const currentMonth = today.getMonth() + 1; // getMonth() returns 0-11
        const currentYear = today.getFullYear();

        // Fungsi untuk mengatur nilai dropdown
        function setDropdownValue(id, value) {
            const dropdown = document.getElementById(id);
            if (dropdown) {
                // Hanya set jika old() tidak ada (form baru, bukan setelah validasi error)
                if (!dropdown.value) {
                    dropdown.value = value;
                }
            }
        }

        // Set nilai dropdown ke tanggal sekarang
        setDropdownValue('start_date_day', currentDay);
        setDropdownValue('start_date_month', currentMonth);
        setDropdownValue('start_date_year', currentYear);

        // --- Opsional: Logika untuk menyesuaikan jumlah hari berdasarkan bulan dan tahun ---
        const dayDropdown = document.getElementById('start_date_day');
        const monthDropdown = document.getElementById('start_date_month');
        const yearDropdown = document.getElementById('start_date_year');

        function updateDaysInMonth() {
            const selectedYear = parseInt(yearDropdown.value);
            const selectedMonth = parseInt(monthDropdown.value);

            if (selectedYear && selectedMonth) {
                // Dapatkan jumlah hari di bulan yang dipilih
                const daysInMonth = new Date(selectedYear, selectedMonth, 0)
                    .getDate(); // Hari ke-0 dari bulan berikutnya

                const currentSelectedDay = parseInt(dayDropdown.value);

                // Bersihkan opsi hari yang ada
                dayDropdown.innerHTML = '<option value="">DD</option>';

                // Tambahkan opsi hari baru
                for (let i = 1; i <= daysInMonth; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = String(i).padStart(2, '0');
                    dayDropdown.appendChild(option);
                }

                // Pilih hari yang sebelumnya dipilih jika masih valid, atau set ke hari terakhir jika melebihi
                if (currentSelectedDay && currentSelectedDay <= daysInMonth) {
                    dayDropdown.value = currentSelectedDay;
                } else if (currentSelectedDay && currentSelectedDay > daysInMonth) {
                    dayDropdown.value = daysInMonth; // Set ke hari terakhir bulan
                }
            } else {
                // Jika tahun atau bulan belum dipilih, reset hari ke default
                dayDropdown.innerHTML = '<option value="">DD</option>';
                for (let i = 1; i <= 31; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = String(i).padStart(2, '0');
                    dayDropdown.appendChild(option);
                }
            }
        }

        // Jalankan saat halaman dimuat (untuk memastikan hari yang benar untuk default tanggal sekarang)
        updateDaysInMonth();

        // Tambahkan event listener saat bulan atau tahun berubah
        monthDropdown.addEventListener('change', updateDaysInMonth);
        yearDropdown.addEventListener('change', updateDaysInMonth);
    });
</script>
