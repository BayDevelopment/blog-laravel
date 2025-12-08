<nav class="bg-gray-800/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company" class="size-8" />
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        {{-- Beranda --}}
                        <a href="{{ url('/') }}" aria-current="page"
                            class="{{ request()->routeIs('/') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                            Beranda
                        </a>

                        {{-- Blog --}}
                        <a href="{{ url('/blog') }}"
                            class="{{ request()->routeIs('blog') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                            Blog
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right side (desktop) --}}
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6 space-x-3">
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium 
                     {{ request()->routeIs('login') ? 'text-white bg-indigo-600' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium
                    {{ request()->routeIs('register')
                        ? 'text-white bg-indigo-600'
                        : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        Register
                    </a>

                </div>
            </div>

            {{-- Mobile menu button --}}
            <div class="-mr-2 flex md:hidden">
                <button type="button" command="--toggle" commandfor="mobile-menu"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <el-disclosure id="mobile-menu" hidden class="block md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="{{ url('/') }}"
                class="{{ request()->is('/') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">
                Beranda
            </a>
            <a href="{{ url('/blog') }}"
                class="{{ request()->is('blog') ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">
                Blog
            </a>
        </div>

        <div class="border-t border-white/10 pt-4 pb-3">
            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('login') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                    Login
                </a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">
                    Register
                </a>
            </div>
        </div>
    </el-disclosure>
</nav>
