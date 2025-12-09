@extends('layouts.user')

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'success',
                    title: @json(session('success'))
                });
            });
        </script>
    @endif

    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="bg-slate-900/80 border border-slate-700/70 shadow-2xl rounded-2xl p-6 md:p-8 backdrop-blur-xl">

            {{-- Header dashboard --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-semibold text-slate-50 tracking-tight">
                        {{ $title }}
                    </h2>
                    <p class="text-sm text-slate-400 mt-1">
                        Selamat datang, <span class="font-semibold text-cyan-400">{{ Auth::user()->name }}</span> 👋
                    </p>
                </div>

                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/80 border border-slate-700 text-xs text-slate-300">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Account Active</span>
                </div>
            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                {{-- Card: Postingan Saya --}}
                <div
                    class="p-5 rounded-2xl bg-gradient-to-br from-cyan-500/20 via-sky-500/10 to-blue-500/10 border border-slate-700/70 shadow-lg flex flex-col justify-between">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">
                                Postingan Saya
                            </p>
                            <p class="text-4xl font-semibold text-slate-50 mt-3 leading-none">
                                {{ $postCount }}
                            </p>
                            <p class="text-xs text-slate-400 mt-2">
                                Total postingan yang sudah kamu buat
                            </p>
                        </div>

                        {{-- Icon --}}
                        <div
                            class="h-12 w-12 rounded-2xl bg-slate-900/80 border border-slate-700 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M5 5H19V19H5V5Z" stroke="currentColor" stroke-width="1.4" />
                                <path d="M8 9H16" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                <path d="M8 13H13" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>

                    {{-- Optional: tombol kecil ke halaman postingan --}}
                    <div class="mt-4">
                        <a href="{{ url('user/semua-blog') ?? '#' }}"
                            class="inline-flex items-center gap-2 text-xs text-cyan-400 hover:text-cyan-300 transition-colors">
                            Lihat semua postingan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M13 6L19 12L13 18" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Slot kartu lain kalau nanti mau nambah --}}
                {{-- 
                <div class="p-5 rounded-2xl bg-slate-900/70 border border-slate-700 shadow-lg">
                    ...
                </div>
                --}}

            </div>
        </div>
    </div>
@endsection
