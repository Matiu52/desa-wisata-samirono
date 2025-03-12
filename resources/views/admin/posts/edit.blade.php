@if (Auth::check())
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Silakan Edit Postingan, ' . Auth::user()->name . '!') }}
            </h2>
        </x-slot>
        <div class="my-4 h-auto bg-gray-50/50">
            <a href="{{ route('posts.index') }}"
                class="ml-2 sm:ml-4 2xl:ml-80 h-20 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali
                ke
                Daftar Post
            </a>
            <div class="p-4 2xl:ml-80 place-items-center">
                <h1 class="text-3xl font-bold mb-6">Edit Post</h1>
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @method('PUT')
                    @include('admin.posts.components.form-post', ['btnText' => 'Edit Post'])
                </form>
                <x-footer-dashboard></x-footer-dashboard>
            </div>
        </div>
    </x-app-layout>
@else
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif
