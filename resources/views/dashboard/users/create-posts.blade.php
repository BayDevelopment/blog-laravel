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
    <div class="max-w-4xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-semibold text-slate-50 tracking-tight">
                Buat Postingan Baru
            </h1>
            <p class="text-sm text-slate-400 mt-1">
                Isi form berikut untuk membuat postingan kamu.
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-slate-900/80 border border-slate-700/70 shadow-2xl rounded-2xl p-6 md:p-7 backdrop-blur-xl">

            <form action="{{ url('/user/postingan-saya/create') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Category --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-1.5">
                        Kategori
                    </label>
                    <select name="category"
                        class="w-full px-3 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                               text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-cyan-400/60
                               focus:border-cyan-400/80 placeholder:text-slate-500 transition-all">
                        <option value="">Pilih kategori...</option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Title --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-1.5">
                        Judul Postingan
                    </label>
                    <input type="text" name="title" id="title"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                              text-slate-100 text-sm placeholder:text-slate-500
                              focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80
                              transition-all"
                        placeholder="Tulis judul postingan" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Author --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-1.5">
                        Penulis
                    </label>
                    <input type="text" value="{{ Auth::user()->name }}" readonly
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-900/40 border border-slate-700/60
                              text-slate-400 text-sm cursor-not-allowed">
                    {{-- user_id tidak ditampilkan --}}
                </div>

                {{-- Slug (auto) --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-1.5">
                        Slug (otomatis)
                    </label>
                    <input type="text" name="slug" id="slug"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-slate-700
                              text-slate-100 text-sm placeholder:text-slate-500
                              focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80
                              transition-all"
                        placeholder="slug otomatis" value="{{ old('slug') }}">
                    @error('slug')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Body --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-1.5">
                        Isi Konten
                    </label>
                    <textarea name="body"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/60 border border-slate-700
                                 text-slate-100 text-sm placeholder:text-slate-500 min-h-[180px]
                                 focus:outline-none focus:ring-2 focus:ring-cyan-400/60 focus:border-cyan-400/80
                                 transition-all"
                        placeholder="Tulis konten postingan..." rows="6">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl
                           bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600
                           text-sm font-semibold text-slate-50 shadow-lg shadow-cyan-500/25
                           hover:brightness-110 hover:shadow-cyan-400/40 active:scale-[0.99]
                           transition-all">
                    Simpan Postingan
                </button>

            </form>
        </div>
    </div>

    {{-- Auto Slug Script --}}
    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('input', function() {
            slugInput.value = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');
        });
    </script>
@endsection
