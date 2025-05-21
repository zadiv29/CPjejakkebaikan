@extends('front.layouts.app')

@section('title', 'Instruksi Pembayaran')

@section('content')
    <section class="mx-auto mt-10 max-w-xl rounded-lg bg-white p-6 shadow-md">
        <h1 class="mb-4 text-center text-xl font-bold">Instruksi Pembayaran</h1>

        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="font-medium">Virtual Account:</span>
                <span class="text-lg font-semibold tracking-wider">{{ $payment->va_number }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium">Bank / Channel:</span>
                <span class="font-semibold text-blue-600">{{ strtoupper($payment->payment_channel) }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium">Metode Pembayaran:</span>
                <span class="text-gray-800">{{ ucfirst($payment->payment_method) }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium">Jumlah yang harus dibayar:</span>
                <span class="font-semibold text-green-600">Rp{{ number_format($payment->amount, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium">Batas Waktu Pembayaran:</span>
                <span
                    class="font-semibold text-red-500">{{ \Carbon\Carbon::parse($payment->expired_at)->translatedFormat('d F Y, H:i') }}</span>
            </div>

            <div class="mt-6">
                <p class="text-justify text-sm text-gray-600">
                    Silakan lakukan pembayaran sebelum batas waktu yang tertera. Gunakan nomor Virtual Account dan pastikan
                    jumlah yang dibayarkan sesuai. Setelah pembayaran berhasil, sistem akan memverifikasi secara otomatis.
                </p>
            </div>
        </div>


    </section>
@endsection

<script>
    setInterval(() => {
        console.log("Mengecek status pembayaran...");
        fetch("{{ route('payment.status', ['payment' => $payment->uuid]) }}")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'paid') {
                    window.location.href = "{{ route('payment.already_verified') }}";
                }

                if (data.status === 'expired') {
                    window.location.href = "{{ route('payment.already_expired') }}"
                }
            });
    }, 5000); // Cek setiap 5 detik
</script>
