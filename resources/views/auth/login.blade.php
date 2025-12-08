@extends('layouts.guest')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 px-4">
        <div class="max-w-md mx-auto bg-white shadow-lg p-8 rounded-xl">
            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                    Login
                </button>
            </form>
        </div>
    </div>

    {{-- SweetAlert sukses setelah register --}}
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end', // pojok kanan atas
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
@endsection
