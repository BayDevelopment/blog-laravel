@extends('layouts.user')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 px-4">

        <div class="bg-white shadow-lg rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-4">Dashboard User</h2>

            <p class="text-gray-700">
                Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!
            </p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Card 1 --}}
                <div class="p-4 bg-indigo-600 text-white rounded-xl shadow">
                    <h3 class="text-lg font-semibold">Profil Saya</h3>
                    <p class="text-sm mt-1 opacity-90">Lihat dan update informasi akun Anda.</p>
                </div>

                {{-- Card 2 --}}
                <div class="p-4 bg-green-600 text-white rounded-xl shadow">
                    <h3 class="text-lg font-semibold">Aktivitas</h3>
                    <p class="text-sm mt-1 opacity-90">Lihat riwayat aktivitas Anda.</p>
                </div>

                {{-- Card 3 --}}
                <div class="p-4 bg-yellow-500 text-white rounded-xl shadow">
                    <h3 class="text-lg font-semibold">Pengaturan</h3>
                    <p class="text-sm mt-1 opacity-90">Sesuaikan preferensi aplikasi.</p>
                </div>

            </div>

        </div>

    </div>
@endsection
