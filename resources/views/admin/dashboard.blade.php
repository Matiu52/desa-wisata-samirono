<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Dashboard Admin, ' . Auth::user()->name . '!') }}
    </x-admin.header>

    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-16">

        {{-- Statistik Section --}}
        <x-admin.section title="Statistik">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <x-admin.stat-card title="Total Posts" :count="$postCount"
                    desc="Jumlah postingan yang dibuat di platform ini." />
                <x-admin.stat-card title="Total Tour Packages" :count="$tourPackageCount"
                    desc="Paket wisata yang tersedia untuk pelanggan." />
                <x-admin.stat-card title="Total Comments" :count="$commentCount"
                    desc="Komentar yang telah diterima dari pengguna." />
                <x-admin.stat-card title="Total Users" :count="$userCount" desc="Jumlah pengguna terdaftar di platform." />
                <x-admin.stat-card title="Total Orders" :count="$orderCount" desc="Jumlah pesanan di platform." />
            </div>
        </x-admin.section>

        {{-- Success Notification --}}
        @if (session('success'))
            <div class="px-2">
                <x-success-notification :message="session('success')" />
            </div>
        @endif

        {{-- Background Image Settings Section --}}
        <x-admin.section title="Ubah Background">
            <x-admin.card>
                <form action="{{ route('background.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Current Background Preview -->

                        @if ($backgroundImage)
                            @php
                                $imageUrl = '';
                                if (isset($backgroundImage->image_path)) {
                                    if (str_starts_with($backgroundImage->image_path, 'cloudinary|')) {
                                        $parts = explode('|', $backgroundImage->image_path);
                                        $imageUrl = $parts[1] ?? '';
                                    } else {
                                        $imageUrl = asset($backgroundImage->image_path);
                                    }
                                }
                            @endphp

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Background Saat Ini</label>
                                <div class="relative">
                                    <img src="{{ $imageUrl }}" alt="Current Background"
                                        class="h-32 w-full object-cover rounded-lg shadow" loading="lazy">
                                    <button type="button" onclick="removeBackgroundImage()"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                                </div>
                            </div>
                        @else
                            <div
                                class="bg-gray-100 h-32 w-full rounded-lg flex items-center justify-center text-gray-500">
                                Tidak ada background yang ditetapkan
                            </div>
                        @endif

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Gambar Baru</label>
                            <input type="file" name="background_image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                required>
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG (Maksimal 2MB)</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Simpan Background
                            </button>
                        </div>
                    </div>
                </form>
            </x-admin.card>
        </x-admin.section>

        {{-- Section Setting --}}
        <x-admin.section title="Pengaturan Section">
            <x-admin.card>
                {{-- Search --}}
                <x-slot name="search">
                    <input type="text" id="search_section" placeholder="Cari section..."
                        class="px-4 py-2 border rounded-md w-full sm:w-64" />
                </x-slot>

                {{-- Tombol Tambah Section --}}
                <x-slot name="action">
                    <x-admin.link-button href="{{ route('home-settings.create') }}">
                        Tambah Section
                    </x-admin.link-button>
                </x-slot>

                {{-- Tabel --}}
                <x-admin.table>
                    <x-slot name="head">
                        <x-admin.th>Posisi Section</x-admin.th>
                        <x-admin.th>Judul</x-admin.th>
                        <x-admin.th>Konten</x-admin.th>
                        <x-admin.th>Jumlah Gambar</x-admin.th>
                        <x-admin.th>Aksi</x-admin.th>
                    </x-slot>
                    <x-slot name="body">
                        <tbody id="section-table-body">
                            @include('components.admin.partials.section-body', ['setting' => $setting])
                        </tbody>
                    </x-slot>
                </x-admin.table>

            </x-admin.card>
        </x-admin.section>

    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchSection(url, keyword = '') {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    q: keyword
                },
                success: function(data) {
                    $('#section-table-body').html(data.html);
                    const newUrl = url + (keyword ? '?q=' + keyword : '');
                    window.history.pushState({}, '', newUrl);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }

        $('#search_section').on('keyup', function() {
            const keyword = $(this).val().toLowerCase();
            if (keyword.length === 0) {
                fetchSection("{{ route('home-settings.search-section') }}");
            } else {
                fetchSection("{{ route('home-settings.search-section') }}", keyword);
            }
        });
    });

    function removeBackgroundImage() {
        if (confirm('Apakah Anda yakin ingin menghapus gambar background saat ini?')) {
            $.ajax({
                url: "{{ route('background.remove-image') }}",
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        alert(response.message);
                        // Reload the page to reflect changes
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Parse the response if available
                    let response = xhr.responseJSON;
                    if (response && response.message) {
                        alert('Error: ' + response.message);
                    } else {
                        alert('Terjadi kesalahan saat menghapus background. Silakan coba lagi.');
                    }
                    console.error("Error removing background image:", error);
                }
            });
        }
    }
</script>
