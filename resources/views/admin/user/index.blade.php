<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Pengaturan User, ' . Auth::user()->name . '!') }}
    </x-admin.header>

    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-16">

        {{-- Success Notification --}}
        @if (session('success'))
            <div class="px-2">
                <x-success-notification :message="session('success')" />
            </div>
        @endif

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

    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
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
    });
</script>
