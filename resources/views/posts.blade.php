<x-user-layout>
    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
        <x-admin.header>
            📰 {{ __('Postingan Terbaru') }}
        </x-admin.header>

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
</x-user-layout>
