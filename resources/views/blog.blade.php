@extends('layouts.guest')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 px-4 space-y-6">

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('blog') }}"
            class="bg-white/90 border border-gray-200 rounded-2xl shadow-sm p-4 md:p-5 flex flex-col md:flex-row gap-4 md:items-end">

            {{-- Search --}}
            <div class="w-full md:w-1/2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Pencarian
                </label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul, isi, atau author..."
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            {{-- Category --}}
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kategori
                </label>
                <select name="category"
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" @selected(request('category') == $cat)>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-2 md:w-auto">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
                    Terapkan
                </button>

                @if (request('search') || request('category'))
                    <a href="{{ route('blog') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Grid Post --}}
        @if ($posts->isEmpty())
            <p class="text-gray-500 text-sm">Belum ada post yang cocok dengan filter.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 flex flex-col">

                        {{-- Header --}}
                        <h2 class="text-2xl font-bold text-gray-900 line-clamp-2">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Author: {{ $post->author }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ $post->created_at->format('d M Y') }} • {{ $post->category }}
                        </p>

                        {{-- Body --}}
                        <div class="mt-4 prose prose-sm text-gray-700 line-clamp-4">
                            {!! \Illuminate\Support\Str::limit(strip_tags($post->body), 160) !!}
                        </div>

                        {{-- Tombol Selengkapnya --}}
                        <a href="{{ url('/blog/' . $post->slug) }}"
                            class="mt-auto block bg-blue-950 hover:bg-blue-900 text-white text-sm font-semibold px-5 py-2
                                  rounded-lg shadow-md hover:shadow-lg transition-all text-center">
                            Selengkapnya
                        </a>

                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
@endsection
