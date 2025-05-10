<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Pelanggan</th>
                <th scope="col" class="px-6 py-3">Paket</th>
                <th scope="col" class="px-6 py-3">Tanggal Pesan</th>
                <th scope="col" class="px-6 py-3">Jumlah Orang</th>
                <th scope="col" class="px-6 py-3">Total</th>
                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $order->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->package->package_name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->people_count }}
                    </td>
                    <td class="px-6 py-4">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <a href="{{ route('orders.show', $order->id) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline" title="Detail">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
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
                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $encodedMessage }}"
                            class="font-medium text-green-600 dark:text-green-500 hover:underline"
                            title="Hubungi via WhatsApp" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada data pesanan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- @if ($orders->hasPages())
        <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-400">
                        Menampilkan
                        <span class="font-medium">{{ $orders->firstItem() }}</span>
                        sampai
                        <span class="font-medium">{{ $orders->lastItem() }}</span>
                        dari
                        <span class="font-medium">{{ $orders->total() }}</span>
                        hasil
                    </p>
                </div>
                <div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    @endif --}}
</div>
