@extends('front.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <section class="mx-auto flex min-h-screen w-full max-w-[640px] flex-col overflow-x-hidden bg-white pb-4">

        {{-- Header --}}
        <div class="header flex flex-col overflow-hidden rounded-b-[50px] bg-gradient-to-b from-[#3CBBDB] to-[#2F5BE0FF] relative">
            <div class="flex justify-between items-center p-4">
                <div class="flex-grow text-center">
                    <h1 class="text-2xl font-extrabold leading-[36px] text-white">
                        Selamat Datang Di Jejak Kebaikan<br>Sudah Berbuat Baik Hari ini?
                    </h1>
                </div>
                
            {{-- Menu Hamburger --}}
<div class="relative z-50">
    <button id="hamburger" class="text-white focus:outline-none transition-transform duration-300 hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <div id="menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl overflow-hidden transform transition-all duration-300 origin-top-right">
        @auth
            {{-- User Profile --}}
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center gap-3">
                    <img src="{{ Auth::user()->avatar ?? asset('assets/images/default-avatar.png') }}" 
                         class="h-10 w-10 rounded-full object-cover border-2 border-blue-500" 
                         alt="Profile">
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">Hi,</span>
                        <span class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
            
            {{-- Menu Items --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profile</span>
            </a>
            
            {{-- Buka Penggalangan --}}
            <a href="https://adminjejakkebaikan.deuscode.co.id/" target="_blank" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 transition-colors duration-200 border-t border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Buka Penggalangan</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-left text-gray-700 hover:bg-blue-50 transition-colors duration-200 border-t border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        @else
            {{-- Menu sebelum login --}}
            <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 transition-colors duration-200 border-t border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>Register</span>
            </a>
        @endauth
    </div>
</div>


            </div>
            <div class="-mt-[33px] h-fit w-full overflow-hidden">
                <img src="{{ asset('assets/images/backgrounds/hero-background.png') }}" class="h-full w-full object-contain"
                    alt="background">
            </div>
        </div>

        {{-- //ANCHOR Kategori --}}
        <div id="category-donasi" class="mt-8 px-2">
            <div class="flex items-center justify-between rounded-md bg-gray-100 px-4 py-2 shadow-md">
                <h2 class="text-[14px] font-bold sm:text-lg">Bantu Kategori Pilihanmu</h2>
                <a href="#"
                    class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:underline">
                    Explore All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="main-carousel mt-[14px]">
                @forelse ($categories as $category)
                    <div class="px-2 first-of-type:pl-4 last-of-type:pr-4">
                        <a href="{{ route('front.category', $category) }}"
                            class="fundrising-card flex min-h-[160px] w-[135px] flex-col items-center gap-3 rounded-[30px] border border-[#E8E9EE] bg-white p-5 shadow-sm transition hover:shadow-md">
                            <div class="flex h-[60px] w-[60px] shrink-0 overflow-hidden">
                                <img src="{{ Storage::url($category->icon) }}" alt="icon" class="object-contain">
                            </div>
                            <span
                                class="my-auto line-clamp-2 text-center text-sm font-semibold">{{ $category->name }}</span>
                        </a>
                    </div>
                @empty
                    <div
                        class="flex w-full flex-col items-center justify-center gap-3 p-8 text-center text-sm text-gray-500">
                        <lottie-player src="{{ asset('lottie/empty.json') }}" background="transparent" speed="1"
                            style="width: 200px; height: 200px;" loop autoplay>
                        </lottie-player>
                        <p class="font-medium">Belum ada kategori tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- //ANCHOR Penggalangan Dana Mendesak --}}
        <div id="best-choices" class="mt-8 px-2">
            <div class="flex items-center justify-between rounded-md bg-gray-100 px-4 py-2 shadow-md">
                <h2 class="text-[14px] font-bold sm:text-lg">Penggalangan Dana Mendesak</h2>
                <a href="#"
                    class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:underline">
                    Explore All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="main-carousel mt-[14px]">
                @forelse($fundraisings as $fundraising)
                    <div class="mb-6 px-2 first-of-type:pl-4 last-of-type:pr-4">
                        <div
                            class="flex w-[208px] flex-col gap-[14px] rounded-2xl border border-[#E8E9EE] bg-white p-[14px] shadow-sm transition hover:shadow-md">
                            <a href="{{ route('front.details', $fundraising) }}">
                                <div class="flex h-[120px] w-full shrink-0 overflow-hidden rounded-2xl">
                                    <img src="{{ Storage::url($fundraising->thumbnail) }}"
                                        class="h-full w-full object-cover" alt="thumbnail">
                                </div>
                            </a>
                            <div class="flex flex-col gap-[6px]">
                                <a href="{{ route('front.details', $fundraising) }}"
                                    class="line-clamp-2 font-bold hover:line-clamp-none">
                                    {{ $fundraising->name }}
                                </a>
                                <p class="text-xs leading-[18px]">Target <span class="font-bold text-[#FF7815]">Rp
                                        {{ number_format($fundraising->target_amount, 0, ',', '.') }}</span></p>
                            </div>
                            <progress value="{{ $fundraising->getPercentageAttribute() }}" max="100"
                                class="h-[6px] w-full overflow-hidden rounded-full"></progress>
                        </div>
                    </div>
                @empty
                    <div
                        class="flex w-full flex-col items-center justify-center gap-3 p-8 text-center text-sm text-gray-500">
                        <lottie-player src="{{ asset('lottie/empty.json') }}" background="transparent" speed="1"
                            style="width: 200px; height: 200px;" loop autoplay>
                        </lottie-player>
                        <p class="font-medium">Belum ada donasi mendesak untuk saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- //ANCHOR Pilihan Donasi Untuk Kamu --}}
        <div id="latest-fundrising" class="mt-8 px-2">
            <div class="flex items-center justify-between rounded-md bg-gray-100 px-4 py-2 shadow-md">
                <h2 class="text-[14px] font-bold sm:text-lg">Pilihan Donasi Untuk Kamu</h2>
                <a href="#"
                    class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:underline">
                    Explore All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="mt-[14px] flex flex-col gap-4 px-4">
                @forelse($fundraisings as $fundraising)
                    <a href="{{ route('front.details', $fundraising) }}" class="card">
                        <div
                            class="flex w-full items-center gap-3 rounded-2xl border border-[#E8E9EE] bg-white p-[14px] shadow-sm transition hover:shadow-md">
                            <div class="flex h-[90px] w-20 shrink-0 overflow-hidden rounded-2xl">
                                <img src="{{ Storage::url($fundraising->thumbnail) }}" class="h-full w-full object-cover"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="line-clamp-1 font-bold hover:line-clamp-none">{{ $fundraising->name }}</p>
                                <p class="text-xs leading-[18px]">Target <span class="font-bold text-[#FF7815]">Rp
                                        {{ number_format($fundraising->target_amount, 0, ',', '.') }}</span></p>
                                <div class="flex items-center gap-1">
                                    <p class="text-xs font-semibold leading-[18px]">
                                        {{ $fundraising->fundraiser->user->name }}</p>
                                    <div class="flex shrink-0">
                                        <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center gap-3 p-8 text-center text-sm text-gray-500">
                        <lottie-player src="{{ asset('lottie/empty.json') }}" background="transparent" speed="1"
                            style="width: 200px; height: 200px;" loop autoplay>
                        </lottie-player>
                        <p class="font-medium">Belum ada pilihan donasi untuk kamu saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- //ANCHOR Voluntrip --}}
        @include('front.views.voluntrip')

    </section>

    <script>
        // JavaScript untuk toggle menu hamburger
        document.getElementById('hamburger').addEventListener('click', function() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>
@endsection