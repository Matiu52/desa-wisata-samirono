<x-user-layout>
    <div class="my-8">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800 tracking-wide">
                💼 Paket Wisata
            </h1>
            {{-- Search --}}
            @include('frontend.tour-packages.components.search')

            {{-- Package --}}
            <div class="mt-8" id="package-container">
                @include('frontend.tour-packages.components.packages')
            </div>
        </div>
    </div>
</x-user-layout>
