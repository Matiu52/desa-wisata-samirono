<aside id="sidebar"
    class="w-64 bg-gray-800 border-r border-gray-300 fixed h-full text-white transform transition-transform duration-300 ease-in-out">
    <div class="h-40 flex items-center justify-center border-b border-gray-300">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="bg-white rounded-full p-4 shadow-md">
            <x-application-logo class="w-20 h-20 block fill-current text-gray-800" />
        </a>
    </div>
    <nav class="mt-4 px-4 text-sm">
        <ul class="space-y-2">
            <li>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white"><i class="fas fa-home mr-2"></i>
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>
            <li class="mt-4 pt-4 uppercase text-xs tracking-wider">Data</li>
            <li>
                <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" class="text-white">
                    <i class="fas fa-file-alt mr-2"></i>
                    {{ __('Post') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('tour-packages.index')" :active="request()->routeIs('tour-packages.index')" class="text-white">
                    <i class="fas fa-suitcase-rolling mr-2"></i>
                    {{ __('Paket Wisata') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" class="text-white">
                    <i class="fas fa-users mr-2"></i>
                    {{ __('User') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('gallery.index')" :active="request()->routeIs('gallery.index')" class="text-white">
                    <i class="fas fa-images mr-2"></i>
                    {{ __('Gallery') }}
                </x-nav-link>
            </li>
            <li>
                {{-- <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')" class="text-white"> --}}
                <i class="fas fa-shopping-cart mr-2"></i>
                {{ __('Pesanan') }}
                {{-- </x-nav-link> --}}
            </li>
            <li class="mt-4 pt-4 uppercase text-xs tracking-wider">Akun</li>
            <li>
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="text-white">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ Auth::user()->name ?? 'User' }}
                </x-nav-link>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')" class="text-white"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('Keluar') }}
                    </x-nav-link>
                </form>
            </li>
        </ul>
    </nav>
</aside>

<button id="toggle-sidebar"
    class="fixed top-4 left-64 z-50 flex flex-col items-start justify-center w-10 h-10 rounded-lg focus:outline-none transition-transform duration-300 ease-in-out">
    <span class="block w-6 h-0.5 bg-gray-800 mb-1"></span>
    <span class="block w-5 h-0.5 bg-gray-800 mb-1"></span>
    <span class="block w-4 h-0.5 bg-gray-800"></span>
</button>
