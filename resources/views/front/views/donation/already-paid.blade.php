@extends('front.layouts.app')

@section('title', 'Instruksi Pembayaran')

@section('content')
    <main class="flex min-h-screen w-full flex-col items-center">
        <div class="mx-auto max-w-xl space-y-7 rounded-lg bg-white p-4 shadow-md">
            <header class="white relative grid grid-cols-1 rounded-lg border-2 border-green-300 px-3 py-2 pb-10">
                <lottie-player src="{{ asset('lottie/payment-successfuly.json') }}" background="transparent" speed="1"
                    class="sm:h-[150px] sm:w-full" loop autoplay>
                </lottie-player>
                <div class="flex flex-col justify-center">
                    <section class="text-center">
                        <h1 class="font-bold text-gray-700 sm:text-2xl">Pembayaran Berhasil</h1>
                        <p class="text-sm text-gray-700 sm:text-base">Silahkan cek email anda untuk melihat detail donasi
                            anda
                        </p>
                    </section>
                </div>
            </header>
            <section class="detail pembayaran relative top-2 rounded-lg border-2">
                <h1 class="absolute left-4 mb-4 -translate-y-1/2 bg-white px-2 text-center text-lg font-bold">Detail
                    Transaksi
                </h1>
                <div class="mt-5 flex flex-col gap-2 p-2">
                    <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                        <span class="font-medium">Metode Pembayaran</span>
                        <span class="text-gray-500">{{ strtoupper($payment->payment_channel) }}
                            {{ $payment->payment_method === 'virtual_account' ? 'Virtual Account' : ($payment->payment_method === 'qris' ? 'QRIS' : '') }}</span>
                    </div>

                    <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                        <span class="font-medium">Virtual Account</span>
                        <div class="flex items-center gap-2">
                            <span id="vaNumber" class="cursor-pointer select-all text-base tracking-wider text-gray-500">
                                {{ $payment->va_number }}
                            </span>
                            <button id="copyVaButton" type="button"
                                class="inline-flex items-center rounded-md border bg-white p-1 font-medium text-gray-700 shadow-sm transition-all duration-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v2M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2">
                                    </path>
                                </svg>
                                <span class="sr-only">Copy Virtual Account Number</span> </button>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                        <span class="font-medium">Total Pembayaran</span>
                        <span
                            class="font-semibold text-green-600">Rp{{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                        <span class="font-medium">Batas Waktu Pembayaran</span>
                        <span
                            class="font-semibold text-red-500">{{ \Carbon\Carbon::parse($payment->expired_at)->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                    <div class="flex flex-col justify-between sm:flex-row sm:items-center">
                        <span class="font-medium">Status Pembayaran</span>
                        <span
                            class="w-fit rounded-md bg-yellow-200 px-2 font-semibold capitalize text-yellow-600">{{ $payment->status }}</span>
                    </div>
                </div>
            </section>
            <section class="detail pembayaran relative top-2 rounded-lg border-2">
                <h1 class="absolute left-4 mb-4 -translate-y-1/2 bg-white px-2 text-center text-lg font-bold">Detail Program
                </h1>
                <div class="mt-5 flex flex-col gap-2 p-2">
                    <div class="flex flex-col justify-between">
                        <span class="font-medium">Nama Program</span>
                        <span class="text-gray-500">{{ $fundraising->name }}</span>
                    </div>
                    <div class="flex flex-col justify-between">
                        <span class="font-medium">Ketegori Program</span>
                        <span class="text-gray-500">{{ $fundraising->category->name }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="h-full font-medium">Tentang Program</span>
                        <span class="text-gray-500">{{ $fundraising->about }} Lorem ipsum dolor sit, amet
                            consectetur
                            adipisicing elit. Dolores, rerum?</span>
                    </div>
                </div>
            </section>
            <section class="detail pembayaran relative top-2 rounded-lg border-2">
                <h1 class="absolute left-4 mb-4 -translate-y-1/2 bg-white px-2 text-center text-lg font-bold">Detail Donatur
                </h1>
                <div class="mt-5 flex flex-col gap-2 p-2">
                    <div class="flex flex-col justify-between">
                        <span class="font-medium">Nama Donatur</span>
                        <span class="text-gray-500">{{ $donatur->name }}</span>
                    </div>

                    <div class="flex flex-col justify-between">
                        <span class="font-medium">Email</span>
                        <div class="flex items-center gap-2">
                            <span id="vaNumber" class="cursor-pointer select-all text-base tracking-wider text-gray-500">
                                {{ $donatur->email }}
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between">
                        <span class="font-medium">Nomor Telepon</span>
                        <span class="font-semibold text-green-600">{{ $donatur->phone_number }}</span>
                    </div>
                </div>
            </section>
            <section class="detail pembayaran relative top-2 rounded-lg border-2">
                <h1 class="absolute left-4 mb-4 -translate-y-1/2 bg-white px-2 text-center text-lg font-bold">
                    Intruksi Pembayaran
                </h1>
                <div class="mt-2 flex flex-col gap-2 p-2">
                    <ul class="list-outside list-disc pl-5">
                        <li class="">
                            Buka aplikasi BRImo dan login dengan username dan password Anda.
                        </li>
                        <li>
                            Pilih Menu BRIVA
                        </li>
                        <li>
                            Masukkan nomor Virtual Account
                        </li>
                        <li>
                            Konfirmasi pembayaran: Jumlah tagihan dan nama merchant akan muncul. Pastikan semua informasi
                            benar.
                        </li>
                        <li>
                            Masukkan PIN BRImo untuk menyelesaikan transaksi.
                        </li>
                    </ul>
                </div>
            </section>
        </div>

    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vaNumberSpan = document.getElementById('vaNumber');
        const copyVaButton = document.getElementById('copyVaButton');

        if (copyVaButton && vaNumberSpan) { // Pastikan elemen ditemukan
            copyVaButton.addEventListener('click', function() {
                const vaText = vaNumberSpan.textContent.trim(); // Ambil teks dan hapus spasi ekstra

                // Menggunakan Clipboard API (cara modern dan disarankan)
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(vaText)
                        .then(() => {
                            // Feedback sukses ke pengguna
                            const originalButtonHtml = copyVaButton.innerHTML;
                            const originalButtonClasses = copyVaButton.className;

                            copyVaButton.innerHTML =
                                `<svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span class="ml-1 text-green-500 font-semibold">Copied!</span>`;
                            copyVaButton.classList.remove('text-gray-700', 'border-gray-300',
                                'hover:bg-gray-50');
                            copyVaButton.classList.add('text-green-500', 'border-green-500',
                                'bg-green-50'); // Atau bg-green-100

                            // Kembalikan ke tampilan semula setelah 2 detik
                            setTimeout(() => {
                                copyVaButton.innerHTML = originalButtonHtml;
                                copyVaButton.className =
                                    originalButtonClasses; // Kembalikan semua kelas
                            }, 2000);
                        })
                        .catch(err => {
                            // Feedback error jika gagal
                            console.error('Gagal menyalin nomor VA:', err);
                            alert('Gagal menyalin nomor VA. Silakan salin secara manual: ' +
                                vaText); // Fallback ke alert
                        });
                } else {
                    // Fallback untuk browser yang tidak mendukung Clipboard API (sangat jarang sekarang)
                    const textarea = document.createElement('textarea');
                    textarea.value = vaText;
                    document.body.appendChild(textarea);
                    textarea.select();
                    try {
                        document.execCommand('copy');
                        alert('Nomor VA berhasil disalin!');
                    } catch (err) {
                        console.error('Gagal menyalin nomor VA (execCommand):', err);
                        alert('Gagal menyalin nomor VA. Silakan salin secara manual: ' + vaText);
                    }
                    document.body.removeChild(textarea);
                }
            });
        }
    });
</script>
