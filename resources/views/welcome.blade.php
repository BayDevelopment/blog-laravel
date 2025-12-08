<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:navlink>{{ $navlink }}</x-slot:navlink>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

        {{-- Left Text Content --}}
        <div class="text-white text-2xl leading-relaxed">

            <h6 class="text-blue-900 font-semibold text-3xl">
                Selamat datang di Blog Teknologi dan Pemrograman
            </h6>

            <p class="text-xl text-gray-50 mt-4 leading-9">
                Temukan inspirasi, tutorial, dan wawasan terbaru seputar coding, website
                development, software engineering, dan tren teknologi masa kini.
                Kami hadir untuk membantumu belajar lebih cepat, berpikir lebih kritis,
                dan berkembang menjadi programmer yang lebih baik.
            </p>

            <ul class="mt-4 text-xl leading-8 space-y-1">
                <li><i class="fa-solid fa-circle-check text-blue-900"></i> Blog mendalam</li>
                <li><i class="fa-solid fa-circle-check text-blue-900"></i> Tips produktivitas developer</li>
            </ul>

            <a href="{{ url('/blog') }}"
                class="inline-block mt-6 px-6 py-3 bg-blue-950 hover:bg-blue-900
                      rounded-2xl shadow-lg text-white text-lg font-medium transition-all">
                Lihat Sekarang..
            </a>
        </div>

        {{-- Right Image --}}
        <div class="flex justify-center">
            <img src="{{ Vite::asset('resources/img/img-logo-front.svg') }}" alt="Illustration"
                class="w-40 sm:w-52 md:w-64 lg:w-80 xl:w-96 2xl:w-[420px] h-auto object-contain drop-shadow-lg" />
        </div>

    </div>
</x-layout>
