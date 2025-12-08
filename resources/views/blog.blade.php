@extends('layouts.guest')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 px-4">

        {{-- Grid 3 kolom --}}
        @if ($posts->isEmpty())
            <p class="text-gray-300">Belum ada post.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 flex flex-col">

                        {{-- Header --}}
                        <h2 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-500">Author: {{ $post->author }}</p>

                        {{-- Body --}}
                        <div class="mt-4 prose prose-sm text-gray-700">
                            {!! \Illuminate\Support\Str::limit($post->body, 120) !!}
                        </div>

                        {{-- Tombol Selengkapnya --}}
                        <a href="{{ url('/blog/' . $post->slug) }}"
                            class="block bg-blue-950 hover:bg-blue-900 text-white text-lg font-semibold px-5 py-2
                                   rounded-lg shadow-md hover:shadow-lg transition-all mt-auto">
                            Selengkapnya
                        </a>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
