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

        {{-- User Setting --}}
        <x-admin.section title="Pengaturan User">
            <x-admin.card>
                {{-- Search --}}
                <x-slot name="search">
                    <input type="text" id="search_user" placeholder="Cari user..."
                        class="px-4 py-2 border rounded-md w-full sm:w-64" />
                </x-slot>

                {{-- Tombol Tambah User --}}
                <x-slot name="action">
                    <x-admin.link-button href="{{ route('user.create') }}">Tambah
                        User</x-admin.link-button>
                </x-slot>
                <x-admin.table>
                    <x-slot name="head">
                        <x-admin.th>Nomor</x-admin.th>
                        <x-admin.th>Nama</x-admin.th>
                        <x-admin.th>Email</x-admin.th>
                        <x-admin.th>Mendaftar Pada</x-admin.th>
                        <x-admin.th>Role</x-admin.th>
                        <x-admin.th>Aksi</x-admin.th>
                    </x-slot>
                    <x-slot name="body">
                        <tbody id="user-table-body">
                            @include('components.admin.partials.user-body', [
                                'users' => $users,
                                'userCount' => $userCount,
                            ])
                        </tbody>
                    </x-slot>
                </x-admin.table>
            </x-admin.card>
        </x-admin.section>

        {{-- Gallery Kunjungan Section --}}
        <x-admin.section title="Pengaturan Gallery Kunjungan">
            <x-admin.card>
                {{--  Search --}}
                <x-slot name="search">
                    <input type="text" id="search_gallery" placeholder="Cari gallery..."
                        class="px-4 py-2 border rounded-md w-full sm:w-64" />
                </x-slot>
                <x-slot name="action">
                    <x-admin.link-button href="{{ route('gallery.create') }}">Tambah Gambar Baru</x-admin.link-button>
                </x-slot>

                <div id="gallery-body">
                    <x-admin.partials.gallery-body :galleries="$galleries" />
                </div>

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

        function fetchUsers(url, keyword = '') {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    q: keyword
                },
                success: function(data) {
                    $('#user-table-body').html(data.html);
                    const newUrl = url + (keyword ? '?q=' + keyword : '');
                    window.history.pushState({}, '', newUrl);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }

        $('#search_user').on('keyup', function() {
            const keyword = $(this).val().toLowerCase();
            if (keyword.length === 0) {
                fetchUsers("{{ route('home-settings.search-user') }}");
            } else {
                fetchUsers("{{ route('home-settings.search-user') }}", keyword);
            }
        });

        function fetchGalleries(url, keyword = '') {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    q: keyword
                },
                success: function(data) {
                    $('#gallery-body').html(data.html);
                    const newUrl = url + (keyword ? '?q=' + keyword : '');
                    window.history.pushState({}, '', newUrl);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }

        $('#search_gallery').on('keyup', function() {
            const keyword = $(this).val().toLowerCase();
            if (keyword.length === 0) {
                fetchGalleries("{{ route('home-settings.search-gallery') }}");
            } else {
                fetchGalleries("{{ route('home-settings.search-gallery') }}", keyword);
            }
        });

    });
</script>
