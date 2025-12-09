@extends('layouts.guest')

@section('content')
    <div
        class="min-h-screen flex items-center rounded-lg justify-center bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 px-4">
        <div class="w-full max-w-md">
            {{-- Brand / Logo kecil di atas --}}
            <div class="flex items-center gap-3 mb-6 justify-center">
                <div
                    class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-blue-500 via-cyan-400 to-emerald-400 flex items-center justify-center shadow-lg">
                    <span class="text-sm font-bold text-slate-900">DEV</span>
                </div>
                <div class="text-slate-100">
                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Control Panel</p>
                    <p class="text-lg font-semibold">Login Dashboard</p>
                </div>
            </div>

            <div class="bg-slate-900/70 backdrop-blur-xl border border-slate-700/60 shadow-2xl rounded-2xl p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-50 tracking-tight">
                        Welcome back
                    </h2>
                    <p class="text-sm text-slate-400 mt-1">
                        Masuk dulu bro, biar bisa upload dan lihat-lihat blog.
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-medium text-slate-200">
                            Email
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                {{-- Icon mail --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M4 6.5C4 5.67157 4.67157 5 5.5 5H18.5C19.3284 5 20 5.67157 20 6.5V17.5C20 18.3284 19.3284 19 18.5 19H5.5C4.67157 19 4 18.3284 4 17.5V6.5Z"
                                        stroke="currentColor" stroke-width="1.4" />
                                    <path d="M5 7L11.1179 11.0786C11.663 11.4409 12.337 11.4409 12.8821 11.0786L19 7"
                                        stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus
                                class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700 text-slate-100 text-sm
                                   placeholder:text-slate-500
                                   focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80
                                   transition-all"
                                placeholder="you@example.com">
                        </div>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label for="password" class="block text-sm font-medium text-slate-200">
                            Password
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                {{-- Icon lock --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect x="5" y="10" width="14" height="9" rx="2" stroke="currentColor"
                                        stroke-width="1.4" />
                                    <path d="M9 10V8.5C9 6.567 10.567 5 12.5 5C14.433 5 16 6.567 16 8.5V10"
                                        stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700 text-slate-100 text-sm
                                   placeholder:text-slate-500
                                   focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80
                                   transition-all"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-200 text-xs">
                                Show
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="flex items-center justify-between text-xs text-slate-400">
                        {{-- <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember"
                                class="h-3.5 w-3.5 rounded border-slate-600 bg-slate-900 text-cyan-400 focus:ring-cyan-500">
                            <span>Keep me signed in</span>
                        </label> --}}

                        {{-- Sesuaikan route kalau punya halaman lupa password --}}
                        {{-- <a href="{{ route('password.request') }}" class="hover:text-cyan-400 transition-colors">
                        Forgot password?
                    </a> --}}
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full mt-2 inline-flex items-center justify-center gap-2 py-2.5 rounded-xl
                           bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600
                           text-sm font-semibold text-slate-50
                           shadow-lg shadow-cyan-500/25
                           hover:brightness-110 hover:shadow-cyan-400/40
                           active:scale-[0.99]
                           transition-all">
                        <span>Sign in</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M13 6L19 12L13 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>

                    {{-- Footnote kecil --}}
                    <p class="text-[11px] text-slate-500 text-center mt-3">
                        Dibuat oleh <span class="text-cyan-400">Bayudev</span>
                    </p>
                </form>
            </div>
        </div>
    </div>

    {{-- Toggle show/hide password --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = event.currentTarget;

            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'Hide';
            } else {
                input.type = 'password';
                btn.textContent = 'Show';
            }
        }
    </script>

    {{-- SweetAlert sukses setelah register --}}
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: @json(session('success')),
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif
@endsection
