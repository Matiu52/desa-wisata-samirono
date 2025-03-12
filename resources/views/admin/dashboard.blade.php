<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight bg-gray-100 dark:bg-gray-900 px-4 py-3 rounded-md">
            {{ __('Selamat datang di Dashboard Admin, ' . Auth::user()->name . '!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex">
            {{-- Main Content --}}
            <div class="flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mx-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 px-4">
                    {{-- Post Count --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border dark:border-gray-700 hover:shadow-lg transform hover:-translate-y-1 transition">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Posts</h3>
                        <p class="text-4xl font-semibold text-gray-900 dark:text-white">{{ $postCount }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah postingan yang dibuat di platform ini.
                        </p>
                    </div>

                    {{-- Tour Package Count --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border dark:border-gray-700 hover:shadow-lg transform hover:-translate-y-1 transition">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Tour Packages</h3>
                        <p class="text-4xl font-semibold text-gray-900 dark:text-white">{{ $tourPackageCount }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Paket wisata yang tersedia untuk pelanggan.
                        </p>
                    </div>

                    {{-- Comment Count --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border dark:border-gray-700 hover:shadow-lg transform hover:-translate-y-1 transition">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Comments</h3>
                        <p class="text-4xl font-semibold text-gray-900 dark:text-white">{{ $commentCount }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Komentar yang telah diterima dari pengguna.
                        </p>
                    </div>

                    {{-- User Count --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border dark:border-gray-700 hover:shadow-lg transform hover:-translate-y-1 transition">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Users</h3>
                        <p class="text-4xl font-semibold text-gray-900 dark:text-white">{{ $userCount }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah pengguna terdaftar di platform.</p>
                    </div>

                    {{-- Order Count --}}
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border dark:border-gray-700 hover:shadow-lg transform hover:-translate-y-1 transition">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Orders</h3>
                        <p class="text-4xl font-semibold text-gray-900 dark:text-white">{{ $orderCount }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah pesanan di platform.</p>
                    </div>
                </div>
                <div class="m-10">
                    @if (session('success'))
                        <x-success-notification :message="session('success')"></x-success-notification>
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl font-semibold mb-4 mt-6 px-4">Pengaturan Section</h1>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex justify-end mb-4 px-4">
                            <a href="{{ route('home-settings.create') }}"
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">
                                Tambah Section
                            </a>
                        </div>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-900">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Nama Section</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Judul</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @if ($setting->isEmpty())
                                        <tr>
                                            <td colspan="3"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                Tidak ada data.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($setting as $set)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4">{{ $set->section }}</td>
                                                <td class="px-6 py-4">{{ $set->title }}</td>
                                                <td class="px-6 py-4 flex space-x-2">
                                                    <a href="{{ route('home-settings.edit', $set) }}"
                                                        class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                                                    <form action="{{ route('home-settings.destroy', $set) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-10 flex justify-center">
                            {{ $setting->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl font-semibold mb-4 mt-6 px-4">Pengaturan User</h1>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex justify-end mb-4 px-4">
                            <a href="{{ route('home-settings.create') }}"
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">
                                Edit User
                            </a>
                        </div>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-900">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Nomor</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Nama</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Email</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Mendaftar Pada</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            Role</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="3"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                Tidak ada data.
                                            </td>
                                        </tr>
                                    @elseif ($userCount < 5)
                                        @foreach ($users as $index => $user)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4">{{ $user->name }}</td>
                                                <td class="px-6 py-4">{{ $user->email }}</td>
                                                <td class="px-6 py-4">{{ $user->created_at }}</td>
                                                <td class="px-6 py-4">{{ $user->role->name }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($users as $index => $user)
                                            @if ($index < 3)
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                                    <td class="px-6 py-4">{{ $user->created_at }}</td>
                                                    <td class="px-6 py-4">{{ $user->role->name }}</td>
                                                </tr>
                                            @elseif ($index == $users->count() - 1)
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                                    <td class="px-6 py-4">{{ $user->created_at }}</td>
                                                    <td class="px-6 py-4">{{ $user->role->name }}</td>
                                                </tr>
                                            @elseif ($index == 3)
                                                <tr>
                                                    <td colspan="5"
                                                        class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                        ...
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
