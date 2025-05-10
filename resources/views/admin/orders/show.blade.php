<x-app-layout>
    <x-admin.header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Pesanan #' . $order->id) }}
            </h2>
        </div>
    </x-admin.header>

    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Info Pesanan --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Informasi Pemesan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Nama:</span> {{ $order->name }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Email:</span> {{ $order->email }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Telepon:</span> {{ $order->phone }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Alamat:</span> {{ $order->address }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Tanggal Pesan:</span>
                            {{ $order->created_at->format('j F Y H:i') }}
                        </p>
                    </div>
                </div>

                @if ($order->notes)
                    <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded">
                        <p class="font-semibold text-gray-700 dark:text-gray-200">Catatan:</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Detail Paket --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Detail Paket Wisata</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Nama Paket:</span> {{ $order->package->package_name }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Durasi:</span> {{ $order->package->duration }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Harga per Orang:</span>
                            Rp {{ number_format($order->package->price, 0, ',', '.') }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-semibold">Jumlah Orang:</span> {{ $order->people_count }}
                        </p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded">
                        <p class="text-lg font-bold text-blue-700 dark:text-blue-300">
                            Total Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Deskripsi Paket</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $order->package->description }}</p>
                </div>

                @if ($order->package->listItems->count() > 0)
                    <div class="mt-4">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Kegiatan Termasuk</h3>
                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                            @foreach ($order->package->listItems as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Aksi --}}
            <div class="flex justify-center gap-4 mb-10">
                <a href="{{ route('orders.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pesanan
                </a>

                @if (auth()->user() && auth()->user()->role_id === 1)
                    @php
                        // Format nomor WhatsApp
                        $whatsappNumber = preg_replace('/[^0-9]/', '', $order->phone);
                        if (substr($whatsappNumber, 0, 1) === '0') {
                            $whatsappNumber = '62' . substr($whatsappNumber, 1);
                        }

                        // Format kegiatan yang termasuk
                        $activities = '';
                        foreach ($order->package->listItems as $item) {
                            $activities .= '• ' . $item->name . "\n";
                        }

                        // Pesan WhatsApp lengkap dengan emoji dalam bentuk teks
                        $waMessage =
                            'Halo ' .
                            $order->name .
                            ",\n\n" .
                            "Kami dari Desa Wisata Samirono\n" .
                            "Mengenai pesanan paket wisata:\n" .
                            "--------------------------------\n" .
                            '*' .
                            $order->package->package_name .
                            "*\n" .
                            'Tanggal Pesan: ' .
                            $order->created_at->format('d/m/Y') .
                            "\n" .
                            'Jumlah Orang: ' .
                            $order->people_count .
                            "\n" .
                            'Total: Rp ' .
                            number_format($order->total_price, 0, ',', '.') .
                            "\n\n" .
                            "Deskripsi Paket:\n" .
                            $order->package->description .
                            "\n\n" .
                            "Kegiatan yang termasuk:\n" .
                            $activities .
                            "\n" .
                            "--------------------------------\n" .
                            "Ada yang bisa kami bantu?\n" .
                            'Terima kasih';

                        // Encode message untuk URL
                        $encodedMessage = rawurlencode($waMessage);
                    @endphp

                    <!-- WhatsApp Contact Button -->
                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $encodedMessage }}" target="_blank"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow flex items-center">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i> Hubungi via WA
                    </a>

                    <!-- Tombol Salin Nomor -->
                    <button onclick="copyPhoneNumber('{{ $whatsappNumber }}', '{{ $order->name }}')"
                        class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded shadow flex items-center">
                        <i class="fas fa-copy mr-2"></i> Salin Nomor
                    </button>
                @endif
            </div>

            {{-- Footer --}}
            <x-footer-dashboard />
        </div>
    </div>
</x-app-layout>
