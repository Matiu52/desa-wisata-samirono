@php
    $currentPage = $tourPackages->currentPage();
    $perPage = $tourPackages->perPage();
    $startIndex = ($currentPage - 1) * $perPage + 1;
@endphp
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@if ($tourPackages->isEmpty())
    <div class="text-center py-6">
        <p class="text-gray-500 text-sm">Tidak ada hasil ditemukan.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($tourPackages as $package)
            <div
                class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 transform hover:scale-[1.02] flex flex-col overflow-hidden">

                <!-- Gambar Utama -->
                @if ($package->images->count())
                    <div x-data="{ activeIndex: 0 }" x-init="setInterval(() => { activeIndex = (activeIndex + 1) % {{ $package->images->count() }} }, 5000)"
                        class="relative w-full h-64 overflow-hidden rounded-lg">
                        @foreach ($package->images as $index => $image)
                            <img x-show="activeIndex === {{ $index }}"
                                src="{{ asset('images/uploads/' . $image->image_path) }}" alt="Gambar Paket"
                                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out"
                                x-transition:enter="transition-opacity ease-out duration-500"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition-opacity ease-in duration-500"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                loading="lazy">
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="No Image"
                        class="w-full h-64 object-cover rounded-lg">
                @endif


                <div class="p-6 flex flex-col flex-grow">
                    <!-- Nama Paket -->
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $package->package_name }}</h2>

                    <!-- Durasi & Harga -->
                    <p class="text-sm text-gray-600 mb-1 flex items-center">
                        <i class="fas fa-clock text-blue-500 mr-2"></i>
                        <strong>Durasi:</strong> {{ $package->duration }} hari
                    </p>
                    <p class="text-sm text-gray-600 mb-3 flex items-center">
                        <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                        <strong>Harga:</strong> Rp {{ number_format($package->price, 0, ',', '.') }}/orang
                    </p>

                    <!-- Deskripsi -->
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($package->description, 100, '...') }}</p>

                    <!-- Galeri Kecil -->
                    @if ($package->images->count() > 1)
                        <div class="flex gap-2 overflow-x-auto mb-4 justify-center">
                            @foreach ($package->images as $image)
                                <img src="{{ asset('images/uploads/' . $image->image_path) }}"
                                    class="w-32 h-32 object-cover rounded-md border" alt="Gambar Tambahan"
                                    loading="lazy">
                            @endforeach
                        </div>
                    @endif

                    <!-- Daftar Kegiatan -->
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">✨ Daftar Kegiatan</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 mb-4">
                        @foreach ($package->listItems as $item)
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i> {{ $item->name }}
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tombol -->
                    <div class="mt-auto">
                        <a href="{{ route('order.form', ['slug' => $package->slug]) }}"
                            class="block text-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition-all shadow-md">
                            Pesan Sekarang!
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Pagination -->
<div class="mt-8">
    {{ $tourPackages->appends(['keyword' => request()->get('keyword')])->links('vendor.pagination.tailwind') }}
</div>
