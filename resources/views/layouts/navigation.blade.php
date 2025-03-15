<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="w-16 h-16 block fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden sm:flex sm:space-x-8 sm:items-center">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                    {{ __('Post') }}
                </x-nav-link>
                <x-nav-link :href="route('tour-packages.index')" :active="request()->routeIs('tour-packages.index')">
                    {{ __('Paket Wisata') }}
                </x-nav-link>

                <!-- Dropdown (Desktop) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                            <span>{{ __('Atur') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('image.manager')" :active="request()->routeIs('image.manager')">
                            {{ __('Atur Gambar') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('carousel.index')" :active="request()->routeIs('carousel.index')">
                            {{ __('Atur Carousels') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Settings Dropdown (Desktop) -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                        <div>{{ Auth::user()->name }}</div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profil') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Keluar') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>

            <!-- Hamburger Icon (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Responsive Navigation Links -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                {{ __('Post') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tour-packages.index')" :active="request()->routeIs('tour-packages.index')">
                {{ __('Paket Wisata') }}
            </x-responsive-nav-link>
        </div>

        <!-- Dropdown for Settings -->
        <div class="px-4 pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                        <span>{{ __('Atur') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('image.manager')" :active="request()->routeIs('image.manager')">
                        {{ __('Atur Gambar') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('carousel.index')" :active="request()->routeIs('carousel.index')">
                        {{ __('Atur Carousels') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- User Information and Logout -->
        <div class="px-4 pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                {{ Auth::user()->name ?? 'User' }}
            </div>
            <div class="font-medium text-sm text-gray-500">
                {{ Auth::user()->email ?? 'user@example.com' }}
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
