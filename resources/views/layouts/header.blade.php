<header class="bg-white dark:bg-gray-900">
    <!-- desktop -->
    <div class="hidden lg:block mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="flex justify-between items-center">
            <div class="mb-6 md:mb-0">
                <a href="{{ route('landing') }}" class="flex items-center">
                    <img src="/logo-one.png" class="size-8 me-3" alt="Pilot Pay Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Pilot Pay</span>
                </a>
            </div>
            <nav class="flex flex-row space-x-4 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                <a href="{{ route('reports.index') }}" class="">Reports</a>
                @guest
                    @if (! request()->routeIs('register'))
                        <a href="{{ route('register') }}" class="">Register</a>
                    @else
                        <a href="{{ route('login') }}" class="">Log In</a>
                    @endif
                @endguest
            </nav>
        </div>
    </div>

    <!-- mobile -->
    <div x-data="{ open: false }" class="block lg:hidden">
        <nav class="p-4">
            <!-- Your navbar content goes here -->
            <div class="flex items-center justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="open = true" class="fill-current text-slate-900 cursor-pointer size-6"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                <div></div>
            </div>
            <div x-show="open" x-transition.duration.500ms @click.away="open = false" class="lg:hidden fixed inset-0 z-50 bg-white">
                <div x-show="open" class="fixed inset-y-0 right-0 max-w-full w-full overflow-y-auto transition-transform transform bg-slate-100">
                    <!-- Mobile menu content -->
                    <div class="h-full flex flex-wrap content-center">
                        <ul class="w-full text-center py-4 px-8 text-xl font-alata uppercase space-y-6">
                            <li class="bg-stone-800 text-white"><a href="{{ route('reports.index') }}" class="block py-2">Reports</a></li>
                            <li class="bg-stone-800 text-white"><a href="{{ route('register') }}" class="block py-2">Register</a></li>
                            <li class="bg-stone-800 text-white"><a href="" class="block py-2">Contact</a></li>
                        </ul>
                        <div class="mt-6 w-full flex justify-center">
                            <svg @click="open = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-stone-800 size-16 cursor-pointer"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>