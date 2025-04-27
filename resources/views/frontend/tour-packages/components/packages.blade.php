@php
    $currentPage = $tourPackages->currentPage();
    $perPage = $tourPackages->perPage();
    $startIndex = ($currentPage - 1) * $perPage + 1;
@endphp

@if ($tourPackages->isEmpty())
    <div class="text-center py-6">
        <p class="text-gray-500 text-sm">Tidak ada hasil ditemukan.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($tourPackages as $package)
            <div
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-500 transform hover:scale-105 flex flex-col overflow-hidden p-6">
                <!-- Konten Paket -->
                <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center justify-center">
                    {{ $package->package_name }}</h2>
                <p class="text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-clock text-blue-500 mr-2"></i> <strong>Durasi:</strong> {{ $package->duration }}
                </p>
                <p class="text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i> <strong>Harga:</strong> Rp
                    {{ number_format($package->price, 0, ',', '.') }}/orang
                </p>
                <p class="text-gray-600 mb-6">{{ Str::limit($package->description, 100, '...') }}</p>

                <!-- Daftar Kegiatan -->
                <h3 class="text-lg font-semibold mb-3 text-gray-800">✨ Daftar Kegiatan</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach ($package->listItems as $item)
                        <li class="text-gray-700 flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i> {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <!-- Tombol Pesan Sekarang -->
                <div class="mt-auto pt-6 text-center">
                    <a href="{{ route('order.form', ['slug' => $package->slug]) }}"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 inline-block w-full font-semibold shadow-md">
                        Pesan Sekarang!
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Pagination -->
<div class="m-3">
    {{ $tourPackages->appends(['keyword' => request()->get('keyword')])->links('vendor.pagination.tailwind') }}
</div>
