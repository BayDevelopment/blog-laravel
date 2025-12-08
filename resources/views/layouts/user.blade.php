<!doctype html>
<html class="h-full bg-gray-900">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'My App' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body class="h-full">
    <div class="min-h-full">
        {{-- Navbar user --}}
        <x-navbar.user />

        {{-- Header component (kalau kamu punya x-header sendiri) --}}
        @isset($navlink)
            <x-header>{{ $navlink }}</x-header>
        @endisset

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Logout form (POST) --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    {{-- SweetAlert2 untuk konfirmasi logout --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnLogout = document.getElementById('btn-logout');

            if (btnLogout) {
                btnLogout.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Yakin ingin keluar?',
                        text: 'Anda akan logout dari aplikasi.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, logout',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        confirmButtonColor: '#ef4444', // merah (Tailwind red-500)
                        cancelButtonColor: '#6b7280', // gray-500
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>

</html>
