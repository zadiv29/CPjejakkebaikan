@extends('front.layouts.app')
@section('title', 'Category Donasi')
@section('content')
    <section class="mx-auto flex min-h-screen w-full max-w-[640px] flex-col space-y-2 overflow-x-hidden bg-white pb-4">
        <div
            class="header flex h-fit flex-col overflow-hidden rounded-b-[50px] bg-[#56BBC5] bg-gradient-to-b from-[#3CBBDB] to-[#EAD380] py-10">
            <nav class="relative flex items-center justify-between px-3 pt-5">
                <div class="absolute flex items-center gap-[10px]">
                    <a href="{{ route('front.index') }}" class="flex h-10 w-10 shrink-0">
                        <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
                    </a>
                </div>
                <p class="w-full text-center text-sm font-semibold text-white">Ayo Berdonasi</p>
            </nav>
            <div class="mt-5">
                <h1 class="text-center text-[26px] font-bold leading-[39px] text-white">{{ $category->name }}</h1>
            </div>
        </div>
        <div class="flex flex-col gap-4 px-4">

            @forelse($category->activeFundraisings as $fundraising)
                <a href="{{ route('front.details', $fundraising) }}" class="card rounded-2xl border border-gray-300">
                    <div class="flex w-full items-center gap-3 rounded-2xl bg-white p-[14px]">
                        <div class="flex h-[90px] w-20 shrink-0 overflow-hidden rounded-2xl">
                            <img src="{{ Storage::url($fundraising->thumbnail) }}" class="h-full w-full object-cover"
                                alt="thumbnail">
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="line-clamp-1 font-bold hover:line-clamp-none">{{ $fundraising->name }}</p>
                            <p class="text-xs leading-[18px]">Target <span class="font-bold text-[#4541FF]">Rp
                                    {{ number_format($fundraising->target_amount, 0, ',', '.') }}</span></p>
                            <div class="flex items-center gap-1 sm:flex-row-reverse sm:justify-end">
                                <p class="text-xs font-semibold leading-[18px] sm:font-medium">
                                    {{ $fundraising->fundraiser->user->name }}</p>
                                <div class="flex shrink-0">
                                    <img src="{{ asset('assets/images/icons/tick-circle.svg') }}" alt="icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p>
                    Belum Ada Donasi
                </p>
            @endforelse
        </div>
    </section>
@endsection
