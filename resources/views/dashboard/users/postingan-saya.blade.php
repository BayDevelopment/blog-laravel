@extends('layouts.user')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                {{-- Tombol Kembali --}}
                <a href="{{ url('user/dashboard') }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 border border-gray-300">
                    <span><i class="fa-solid fa-angle-left"></i></span> Kembali
                </a>

                {{-- Tombol Tambah --}}
                <a href="{{ route('page.create') }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 shadow">
                    <span><i class="fa-solid fa-plus"></i></span> Tambah
                </a>
            </div>

            <div>
                @isset($navlink)
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $navlink }}
                    </p>
                @endisset
            </div>
        </div>


        {{-- Filter & Search --}}
        <form method="GET" action="{{ url()->current() }}"
            class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">

            <div class="w-full md:w-1/2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Pencarian
                </label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul, isi, atau author..."
                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

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

            <div class="flex gap-2 md:w-auto">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
                    Terapkan
                </button>

                {{-- Tombol reset filter --}}
                @if (request('search') || request('category'))
                    <a href="{{ url()->current() }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Jika tidak ada postingan --}}
        @if ($d_post_byUser->isEmpty())
            <div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-800">
                Kamu belum memiliki postingan.
            </div>
        @else
            <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                #
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Kategori
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Judul
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Author
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Dibuat Pada
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach ($d_post_byUser as $index => $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ ($d_post_byUser->currentPage() - 1) * $d_post_byUser->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <span
                                        class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700">
                                        {{ $post->category }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 font-medium">
                                    {{ $post->title }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $post->author }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ $post->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-right">
                                    <div class="flex flex-nowrap space-x-2 justify-end">
                                        <a href="{{ route('posts.show', $post->id) }}"
                                            class="inline-flex items-center rounded-md border border-gray-300 px-2.5 py-1 text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Lihat
                                        </a>

                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="inline-flex items-center rounded-md border border-amber-300 px-2.5 py-1 text-xs font-medium text-amber-800 bg-amber-50 hover:bg-amber-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus postingan ini?')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center rounded-md border border-red-300 px-2.5 py-1 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $d_post_byUser->links() }}
            </div>
        @endif
    </div>
@endsection
