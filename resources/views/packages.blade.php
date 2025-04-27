<x-user-layout>
    <div class="my-8">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800 tracking-wide">
                💼 Paket Wisata
            </h1>
            @if (session('success'))
                <div id="success-alert"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    </button>
                </div>
            @endif
            {{-- Search --}}
            @include('frontend.tour-packages.components.search')

            {{-- Package --}}
            <div class="mt-8" id="package-container">
                @include('frontend.tour-packages.components.packages')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }
        });
    </script>
</x-user-layout>
