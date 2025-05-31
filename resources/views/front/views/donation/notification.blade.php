@extends('front.layouts.app')

@section('content')
    <div class="flex h-screen w-full items-center justify-center py-16 text-center">
        <div
            class="border-gradient-to-r mx-auto max-w-2xl transform rounded-xl border-2 bg-white from-green-400 via-teal-500 to-blue-500 p-10 shadow-2xl transition-all duration-500 hover:scale-105 hover:shadow-xl">
            <div class="mb-8 flex animate-bounce items-center justify-center">
                <x-icon.mail />
            </div>
            <h1 class="mb-6 text-2xl font-extrabold tracking-tight text-gray-800">Terima telah bersedia memberikan bantuan.
                Donasi anda sangat di butuhkan di program {{ $fundraising->name }}!</h1>
            <div>

                <p class="mb-4 text-xl text-gray-700">Kami telah mengirimkan email verifikasi pembayaran ke alamat email
                    <strong>{{ $donatur->email }}</strong> untuk melanjutkan pembayaran donasi anda.
                </p>
                <p class="text-lg text-gray-600">Silakan buka email Anda dan klik tautan verifikasi untuk melanjutkan ke
                    pembayaran.</p>
            </div>
        </div>
    </div>
@endsection
