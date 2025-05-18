<x-user-layout>
    <div class="my-8">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800 tracking-wide">
                📰 Postingan Terbaru
            </h1>

            {{-- Postingan Section --}}
            <x-admin.section title="Daftar Postingan">
                <x-admin.card>
                    <x-slot name="search">
                        @include('frontend.posts.components.search')
                    </x-slot>

                    <div id="post-container" class="mt-6">
                        @include('frontend.posts.components.posts')
                    </div>
                </x-admin.card>
            </x-admin.section>
        </div>
    </div>
</x-user-layout>
