@extends('front.layouts.app') {{-- Ganti sesuai layout-mu --}}

@section('content')
    <div class="container py-5 text-center">
        <h1 class="text-danger">Pembayaran Kadaluarsa</h1>
        <p>Maaf, waktu untuk menyelesaikan pembayaran sudah habis.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection
