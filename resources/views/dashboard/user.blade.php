@extends('layouts.user')

@section('content')
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

    <div class="max-w-7xl mx-auto mt-8 px-4">

        <div class="bg-indigo-200 shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

            <p class="text-gray-700">
                Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!
            </p>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                {{-- Card: Postingan Saya --}}
                <div class="p-6 bg-indigo-600 text-white rounded-xl shadow flex flex-col items-start">
                    <h3 class="text-lg font-semibold">Postingan Saya</h3>

                    <p class="text-4xl font-bold mt-4">
                        {{ $postCount }}
                    </p>

                    <p class="text-sm opacity-90 mt-1">Total postingan yang Anda buat</p>
                </div>

            </div>

        </div>

    </div>
@endsection
