<x-app-layout>
    <x-admin.header>
        {{ __('Selamat datang di Pengaturan Gallery, ' . Auth::user()->name . '!') }}
    </x-admin.header>

    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-16">
        {{-- Success Notification --}}
        @if (session('success'))
            <div class="px-2">
                <x-success-notification :message="session('success')" />
            </div>
        @endif
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
