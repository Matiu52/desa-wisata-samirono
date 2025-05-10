<x-app-layout>
    <x-admin.header>
        {{ __('Detail Pesan dari ' . $message->name) }}
    </x-admin.header>

    <div class="py-6 bg-gray-50 dark:bg-gray-900 h-full">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="px-2">
                    <x-success-notification :message="session('success')" />
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Nama:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $message->name }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Email:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $message->email }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Telepon:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $message->phone }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Subjek:</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $message->subject }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Pesan:</h3>
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $message->message }}</p>
                </div>

                <div class="flex justify-between items-center pt-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Dikirim {{ $message->created_at->format('d M Y, H:i') }}
                    </span>

                    <a href="{{ route('contact-messages.index') }}" class="text-blue-600 hover:underline text-sm">
                        ← Kembali ke daftar pesan
                    </a>
                </div>
            </div>

            <x-footer-dashboard class="mt-6"></x-footer-dashboard>
        </div>
    </div>
</x-app-layout>
