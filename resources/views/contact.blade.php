<x-user-layout>
    <div class="container mx-auto px-4 py-12">
        <!-- Judul Section -->
        <h2 class="text-3xl font-bold text-center text-green-800 mb-8">Hubungi Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kontak -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-green-700 mb-4">Informasi Kontak</h3>

                <div class="space-y-4">
                    <!-- Alamat -->
                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Alamat Desa Wisata</h4>
                            <p class="text-gray-600">{{ $contactInfo['address'] }}</p>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Telepon</h4>
                            @foreach ($contactInfo['phones'] as $phone)
                                <p class="text-gray-600">{{ $phone }}</p>
                            @endforeach
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Email</h4>
                            @foreach ($contactInfo['emails'] as $email)
                                <p class="text-gray-600">{{ $email }}</p>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sosial Media -->
                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Sosial Media</h4>
                            <div class="flex space-x-3 mt-2">
                                <a href="{{ $contactInfo['social_media']['tiktok'] }}"
                                    class="text-gray-600 hover:text-gray-800">
                                    <i class="fab fa-tiktok text-xl"></i>
                                </a>
                                <a href="{{ $contactInfo['social_media']['instagram'] }}"
                                    class="text-pink-600 hover:text-pink-800">
                                    <i class="fab fa-instagram text-xl"></i>
                                </a>
                                <a href="{{ $contactInfo['social_media']['youtube'] }}"
                                    class="text-red-600 hover:text-red-800">
                                    <i class="fab fa-youtube text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Form Kontak -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-green-700 mb-4">Kirim Pesan</h3>
                <x-success-notification />
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="tel" id="phone" name="phone" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subjek</label>
                        <select id="subject" name="subject" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border">
                            <option value="">Pilih subjek...</option>
                            <option value="Informasi Wisata">Informasi Wisata</option>
                            <option value="Pemesanan Paket">Pemesanan Paket</option>
                            <option value="Kerjasama">Kerjasama</option>
                            <option value="Keluhan/Saran">Keluhan/Saran</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                        <textarea id="message" name="message" rows="4" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 border"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden">
            <h3 class="text-xl font-semibold text-green-700 p-6 pb-0">Lokasi Kami</h3>
            <div class="h-96 w-full">
                <iframe src="{{ $contactInfo['map_embed'] }}" width="100%" height="100%" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="rounded-b-xl">
                </iframe>
            </div>
        </div>
    </div>
</x-user-layout>
