<header>
    <nav x-data="{ open: false }"
        class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo dan Nama (Paling Kiri) -->
                <div class="flex items-center">
                    <a href="{{ route('homepage') }}" class="flex items-center space-x-2">
                        <x-application-logo class="h-10 w-10 text-gray-800 dark:text-gray-200" />
                        <span class="text-xl font-semibold text-gray-800 dark:text-gray-200 hidden sm:block">
                            Desa Wisata Samirono
                        </span>
                    </a>
                </div>

                <!-- Menu Tengah (Desktop) -->
                <div class="hidden md:flex md:items-center md:justify-center md:flex-1 md:px-8">
                    <div class="flex space-x-8">
                        <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                            <i class="fas fa-home mr-2"></i> Beranda
                        </x-nav-link>
                        <x-nav-link :href="route('frontend.posts')" :active="request()->routeIs('frontend.posts')">
                            <i class="fas fa-newspaper mr-2"></i> Artikel
                        </x-nav-link>
                        <x-nav-link :href="route('frontend.tour-packages')" :active="request()->routeIs('frontend.tour-packages')">
                            <i class="fas fa-suitcase mr-2"></i> Paket Wisata
                        </x-nav-link>
                        <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                            <i class="fas fa-envelope mr-2"></i> Kontak
                        </x-nav-link>
                        <x-nav-link href="#" :active="request()->routeIs('about')">
                            <i class="fas fa-info-circle mr-2"></i> Tentang
                        </x-nav-link>
                    </div>
                </div>

                <!-- User Authentication (Paling Kanan) -->
                <div class="flex items-center">
                    <div class="hidden md:flex items-center space-x-4">
                        @auth
                            <!-- Menu Admin (hanya tampil untuk admin) -->
                            @if (Auth::user()->role->name === 'admin')
                                <x-nav-link :href="route('dashboard')"
                                    class="px-3 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                                    <i class="fas fa-shield-alt mr-2"></i> Admin
                                </x-nav-link>
                            @endif

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none transition">
                                        <div>{{ Auth::user()->name }}</div>
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @if (Auth::user()->role->name === 'admin')
                                        <x-dropdown-link :href="route('dashboard')">
                                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                        </x-dropdown-link>
                                    @endif
                                    <x-dropdown-link :href="route('profile.edit')">
                                        <i class="fas fa-user mr-2"></i> Profil
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <x-nav-link :href="route('login')"
                                class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                            </x-nav-link>
                            @if (Route::has('register'))
                                <x-nav-link :href="route('register')"
                                    class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    <i class="fas fa-user-plus mr-2"></i> Daftar
                                </x-nav-link>
                            @endif
                            <x-nav-link :href="route('admin.login')"
                                class="px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-shield-alt mr-2"></i> Admin
                            </x-nav-link>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden ml-4">
                        <button @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" :class="{ 'hidden': open, 'block': !open }" stroke="currentColor"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="h-6 w-6" :class="{ 'block': open, 'hidden': !open }" stroke="currentColor"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                    <i class="fas fa-home mr-3"></i> Beranda
                </x-nav-link>
                <x-nav-link :href="route('frontend.posts')" :active="request()->routeIs('frontend.posts')">
                    <i class="fas fa-newspaper mr-3"></i> Artikel
                </x-nav-link>
                <x-nav-link :href="route('frontend.tour-packages')" :active="request()->routeIs('frontend.tour-packages')">
                    <i class="fas fa-suitcase mr-3"></i> Paket Wisata
                </x-nav-link>
                <x-nav-link :href="'#'" :active="request()->routeIs('contact')">
                    <i class="fas fa-envelope mr-3"></i> Kontak
                </x-nav-link>
                <x-nav-link :href="'#'" :active="request()->routeIs('about')">
                    <i class="fas fa-info-circle mr-3"></i> Tentang
                </x-nav-link>

                @auth
                    @if (Auth::user()->role->name === 'admin')
                        <x-nav-link :href="route('dashboard')">
                            <i class="fas fa-shield-alt mr-3"></i> Admin
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        <i class="fas fa-user mr-3"></i> Profil
                    </x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                        </x-nav-link>
                    </form>
                @else
                    <x-nav-link :href="route('login')">
                        <i class="fas fa-sign-in-alt mr-3"></i> Masuk
                    </x-nav-link>
                    @if (Route::has('register'))
                        <x-nav-link :href="route('register')">
                            <i class="fas fa-user-plus mr-3"></i> Daftar
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('admin.login')">
                        <i class="fas fa-shield-alt mr-3"></i> Admin
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </nav>
</header>
