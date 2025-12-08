@extends('layouts.guest')

@section('content')
    <div class="max-w-3xl mx-auto mt-8">
        <a href="{{ url('/blog') }}"
            class="inline-block mb-3 bg-blue-950 hover:bg-blue-900 text-white text-md font-semibold px-6 py-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200">
            Kembali
        </a>

        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            {{-- Header --}}
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Author: {{ $post->author }}</p>
                </div>

                <div class="text-right">
                    <p class="text-xs text-gray-400">Created at</p>
                    <p class="text-sm font-medium text-gray-600">
                        {{ $post->created_at ? $post->created_at->format('d M Y') : 'waktu belum diatur' }}
                    </p>
                </div>
            </div>

            {{-- Body --}}
            <div class="mt-6 prose prose-gray">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>
    </div>
@endsection
