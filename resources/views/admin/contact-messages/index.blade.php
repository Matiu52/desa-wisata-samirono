<x-app-layout>
    <x-admin.header>
        {{ __('Pesan Masuk dari Pengunjung') }}
    </x-admin.header>

    <div class="py-6 bg-gray-50 dark:bg-gray-900 h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="px-2">
                    <x-success-notification :message="session('success')" />
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white dark:bg-gray-800 p-4">
                <table class="min-w-full table-auto text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Telepon</th>
                            <th class="px-4 py-2">Subjek</th>
                            <th class="px-4 py-2">Dikirim</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $msg)
                            <tr class="border-t dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $msg->name }}</td>
                                <td class="px-4 py-2">{{ $msg->email }}</td>
                                <td class="px-4 py-2">{{ $msg->phone }}</td>
                                <td class="px-4 py-2">{{ $msg->subject }}</td>
                                <td class="px-4 py-2">{{ $msg->created_at->diffForHumans() }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('contact-messages.show', $msg) }}"
                                        class="text-blue-600 hover:underline">Lihat</a>
                                    <form action="{{ route('contact-messages.destroy', $msg) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                    Tidak ada pesan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $messages->links() }}
                </div>
            </div>

            <x-footer-dashboard></x-footer-dashboard>
        </div>
    </div>
</x-app-layout>
