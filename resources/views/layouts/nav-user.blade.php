<header>
    <nav x-data="{ open: false }"
        class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('homepage') }}" class="flex items-center space-x-3 logo">
                <x-application-logo class="w-12 h-12 fill-current text-gray-800 dark:text-gray-200" />
                <span class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Desa Wisata Samirono
                </span>
            </a>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden xl:flex space-x-8">
                <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                    <i class="fas fa-home mr-2"></i> Home
                </x-nav-link>
                <x-nav-link :href="route('frontend.posts')" :active="request()->routeIs('frontend.posts')">
                    <i class="fas fa-newspaper mr-2"></i> Postingan
                </x-nav-link>
                <x-nav-link :href="route('frontend.tour-packages')" :active="request()->routeIs('frontend.tour-packages')">
                    <i class="fas fa-suitcase mr-2"></i> Paket
                </x-nav-link>
                <x-nav-link href="#" :active="request()->is('contact*')">
                    <i class="fas fa-envelope mr-2"></i> Contact
                </x-nav-link>
                <x-nav-link href="#" :active="request()->is('about*')">
                    <i class="fas fa-info-circle mr-2"></i> About
                </x-nav-link>
            </div>

            <!-- User Authentication Links -->
            <div class="hidden xl:flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @if (Auth::user()->role->name === 'admin')
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                @endif
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profil') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Keluar') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <x-nav-link :href="route('login')">Masuk</x-nav-link>
                        @if (Route::has('register'))
                            <x-nav-link :href="route('register')">Daftar</x-nav-link>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Hamburger Menu Button (Mobile) -->
            <div class="flex xl:hidden">
                <button @click="open = !open" class="text-gray-600 dark:text-gray-300 focus:outline-none">
                    <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" class="md:hidden mobile-menu" :class="{ 'open': open }">
            <div class="px-4 pt-2 pb-3 space-y-2">
                <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                    <i class="fas fa-home mr-2"></i> Home
                </x-nav-link>
                <x-nav-link :href="route('frontend.posts')" :active="request()->routeIs('frontend.posts')">
                    <i class="fas fa-newspaper mr-2"></i> Postingan
                </x-nav-link>
                <x-nav-link :href="route('frontend.tour-packages')" :active="request()->routeIs('frontend.tour-packages')">
                    <i class="fas fa-suitcase mr-2"></i> Paket
                </x-nav-link>
                <x-nav-link href="#" :active="request()->is('contact*')">
                    <i class="fas fa-envelope mr-2"></i> Contact
                </x-nav-link>
                <x-nav-link href="#" :active="request()->is('about*')">
                    <i class="fas fa-info-circle mr-2"></i> About
                </x-nav-link>
                @if (Route::has('login'))
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @if (Auth::user()->role->name === 'admin')
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                @endif
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profil') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Keluar') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <x-nav-link :href="route('login')">Masuk</x-nav-link>
                        @if (Route::has('register'))
                            <x-nav-link :href="route('register')">Daftar</x-nav-link>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>
</header>
