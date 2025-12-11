@extends('layouts.user')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">

        {{-- Top Bar --}}
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                {{-- Tombol Kembali --}}
                <a href="{{ url('/user/postingan-saya') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl 
                          bg-slate-900/70 border border-slate-700 text-slate-100 text-sm font-medium 
                          hover:bg-slate-800 hover:border-slate-500 transition-all">
                    <i class="fa-solid fa-angle-left text-xs"></i>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- Navlink / Info kecil --}}
            @isset($navlink)
                <p class="text-xs md:text-sm text-slate-400">
                    {{ $navlink }}
                </p>
            @endisset
        </div>

        {{-- Card Utama Post --}}
        <div
            class="bg-gradient-to-b from-slate-900/90 via-slate-950/95 to-slate-950
                   border border-slate-800/80 rounded-2xl shadow-2xl overflow-hidden
                   backdrop-blur-xl">

            {{-- Header Post (Title + Meta) --}}
            <div class="px-6 md:px-8 pt-6 md:pt-8 pb-4 border-b border-slate-800/80 bg-slate-950/60">
                {{-- Kategori --}}
                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-cyan-500/10 border border-cyan-400/30
                               px-3 py-1 text-xs font-semibold tracking-wide uppercase text-cyan-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        {{ $post->category }}
                    </span>
                </div>

                {{-- Judul --}}
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-50 mb-3">
                    {{ $post->title }}
                </h1>

                {{-- Meta: Author, Tanggal, Estimasi Waktu Baca --}}
                @php
                    $readTime = max(1, ceil(str_word_count(strip_tags($post->body)) / 200));
                @endphp

                <div class="flex flex-wrap items-center gap-3 text-xs md:text-sm text-slate-400">
                    {{-- Author Avatar Circle --}}
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 
                                   flex items-center justify-center text-xs font-semibold text-white shadow-lg">
                            {{ strtoupper(substr($post->author, 0, 1)) }}
                        </div>
                        <div class="leading-tight">
                            <p class="font-medium text-slate-200">
                                {{ $post->author }}
                            </p>
                            <p class="text-[11px] text-slate-400">
                                Penulis
                            </p>
                        </div>
                    </div>

                    <span class="hidden md:inline-block w-px h-4 bg-slate-700"></span>

                    <div class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-[11px] text-slate-500"></i>
                        <span>
                            {{ $post->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <span class="hidden md:inline-block w-px h-4 bg-slate-700"></span>

                    <div class="flex items-center gap-1.5">
                        <i class="fa-regular fa-clock text-[11px] text-slate-500"></i>
                        <span>Perkiraan baca {{ $readTime }} menit</span>
                    </div>
                </div>
            </div>

            {{-- Thumbnail (opsional, jika punya) --}}
            @if (!empty($post->thumbnail_url ?? null))
                <div class="relative overflow-hidden border-b border-slate-800/80">
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                        class="w-full max-h-[360px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent"></div>
                </div>
            @endif

            {{-- Body Konten --}}
            <div class="px-6 md:px-8 py-6 md:py-8">
                <div class="text-sm md:text-[15px] leading-relaxed text-slate-100 space-y-4">
                    {{-- Jika body HTML (pakai editor) --}}
                    {!! nl2br(e($post->body)) !!}
                    {{-- 
                        Kalau konten kamu memang HTML dari editor (mis. Trix / TinyMCE), 
                        ganti baris di atas dengan:
                        {!! $post->body !!}
                    --}}
                </div>
            </div>

            {{-- Footer: Aksi --}}
            <div
                class="px-6 md:px-8 py-4 border-t border-slate-800/80 bg-slate-950/70 flex flex-wrap items-center justify-between gap-3">

                <div class="text-xs text-slate-500">
                    Terakhir diperbarui:
                    <span class="font-medium text-slate-300">
                        {{ $post->updated_at->format('d M Y, H:i') }}
                    </span>
                </div>

                <div class="flex flex-wrap gap-2">
                    {{-- Edit --}}
                    <a href="{{ route('page.update', $post->slug) }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-amber-400/40
                              bg-amber-500/10 px-3.5 py-2 text-xs font-medium text-amber-200
                              hover:bg-amber-500/20 hover:border-amber-300 transition-all">
                        <i class="fa-regular fa-pen-to-square text-[11px]"></i>
                        <span>Edit</span>
                    </a>

                    {{-- Hapus --}}
                    <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}"
                        method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl border border-red-400/40
                                       bg-red-500/10 px-3.5 py-2 text-xs font-medium text-red-200
                                       hover:bg-red-500/20 hover:border-red-300 transition-all">
                            <i class="fa-regular fa-trash-can text-[11px]"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
