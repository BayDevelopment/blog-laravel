@extends('layouts.guest')

@section('content')
    <div
        class="min-h-screen rounded-2xl flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 px-4">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="flex items-center gap-3 mb-6 justify-center">
                <div
                    class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-blue-500 via-cyan-400 to-emerald-400 flex items-center justify-center shadow-lg">
                    <span class="text-sm font-bold text-slate-900">DEV</span>
                </div>
                <div class="text-slate-100">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Control Panel</p>
                    <p class="text-lg font-semibold">Register Dashboard</p>
                </div>
            </div>

            {{-- Card --}}
            <div class="bg-slate-900/70 backdrop-blur-xl border border-slate-700/60 shadow-2xl rounded-2xl p-8">

                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-50 tracking-tight">Create Account</h2>
                    <p class="text-sm text-slate-400 mt-1">Daftar dulu bro biar bisa upload & lihat-lihat blog.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Grid 2 kolom --}}
                    <div class="grid grid-cols-2 gap-4">

                        {{-- Name --}}
                        <div class="space-y-1.5">
                            <label for="name" class="block text-sm font-medium text-slate-200">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                                       text-slate-100 text-sm placeholder:text-slate-500
                                       focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80 transition-all">

                            @error('name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-1.5">
                            <label for="email" class="block text-sm font-medium text-slate-200">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                                       text-slate-100 text-sm placeholder:text-slate-500
                                       focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80 transition-all">

                            @error('email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="space-y-1.5">
                            <label for="password" class="block text-sm font-medium text-slate-200">Password</label>
                            <input id="password" type="password" name="password"
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                                       text-slate-100 text-sm placeholder:text-slate-500
                                       focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80 transition-all">

                            @error('password')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="space-y-1.5">
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-200">
                                Confirm Password
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                                       text-slate-100 text-sm placeholder:text-slate-500
                                       focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80 transition-all">
                        </div>

                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full mt-6 inline-flex items-center justify-center gap-2 py-2.5 rounded-xl
                               bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600
                               text-sm font-semibold text-slate-50 shadow-lg shadow-cyan-500/25
                               hover:brightness-110 hover:shadow-cyan-400/40 active:scale-[0.99] transition-all">

                        Create Account
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M13 6L19 12L13 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>

                    <p class="text-[11px] text-slate-500 text-center mt-3">
                        Dibuat oleh <span class="text-cyan-400">Bayudev</span>
                    </p>

                </form>
            </div>
        </div>
    </div>
@endsection
