<x-user-layout>
    <div class="flex items-center justify-center bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen py-8 px-4">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-6 tracking-wide">🛒 Pesan Sekarang</h1>

            <!-- Detail Paket Wisata -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Detail Paket Wisata</h2>
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-6 shadow-md">
                    <h3 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i> {{ $selectedPackage->package_name }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-gray-700">
                            <strong>💰 Harga:</strong> Rp
                            {{ number_format($selectedPackage->price, 0, ',', '.') }}/orang
                        </p>
                        <p class="text-gray-700">
                            <strong>⏳ Durasi:</strong> {{ $selectedPackage->duration }}
                        </p>
                    </div>
                    <p class="text-gray-700 mt-4">
                        <strong>📖 Deskripsi:</strong> {{ $selectedPackage->description }}
                    </p>

                    <h4 class="text-lg font-semibold text-blue-800 mt-6 mb-2">📋 Kegiatan yang Termasuk</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        @foreach ($selectedPackage->listItems as $item)
                            <li class="text-gray-700 flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i> {{ $item->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @auth
                <!-- Form Pemesanan -->
                <form action="{{ route('order.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" name="package_id" value="{{ $selectedPackage->id }}" />

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-lg font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required
                            class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama lengkap Anda" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-lg font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan alamat email Anda" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="phone" class="block text-lg font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" required pattern="^\+?\d{10,15}$"
                            title="Masukkan nomor telepon yang valid (10-15 digit, opsional diawali dengan +)"
                            class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nomor telepon Anda" />
                    </div>

                    <!-- Catatan Tambahan -->
                    <div>
                        <label for="notes" class="block text-lg font-semibold text-gray-700 mb-2">Catatan
                            Tambahan</label>
                        <textarea id="notes" name="notes" rows="4"
                            class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Opsional: Masukkan permintaan khusus atau pertanyaan."></textarea>
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="text-center">
                        <button type="submit"
                            class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 font-semibold shadow-lg w-full sm:w-auto">
                            Kirim Pesanan
                        </button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Silakan Login untuk Memesan</h2>
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-all duration-300 font-semibold shadow-lg">
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
</x-user-layout>
