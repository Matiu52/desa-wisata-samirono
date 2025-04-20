@if (Auth::check())
    <x-app-layout>
        <x-admin.header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Silahkan Buat Postingan, ' . Auth::user()->name . '!') }}
                </h2>
                <x-admin.link-button href="{{ route('posts.index') }}">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pengaturan Postingan
                </x-admin.link-button>
            </div>
        </x-admin.header>

        <div class="py-12">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Buat Post Baru</h1>
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        @include('admin.posts.components.form-post')

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end space-x-4 mt-6">
                            <a href="{{ route('posts.index') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-save mr-2"></i> Buat Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif
