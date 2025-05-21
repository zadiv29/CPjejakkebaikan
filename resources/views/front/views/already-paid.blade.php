@extends('front.layouts.app') {{-- Sesuaikan dengan layout yang kamu pakai --}}

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-green-50">
        <div class="max-w-md rounded-xl bg-white p-8 text-center shadow">
            <h1 class="mb-4 text-2xl font-bold text-green-600">Pembayaran Berhasil!</h1>
            <p class="mb-6 text-gray-700">Terima kasih telah melakukan pembayaran. Pendaftaran kamu telah diverifikasi.</p>
            <a href="{{ route('front.index') }}"
                class="inline-block rounded bg-green-600 px-4 py-2 text-white transition hover:bg-green-700">Kembali ke
                Beranda</a>
        </div>
    </div>
@endsection
