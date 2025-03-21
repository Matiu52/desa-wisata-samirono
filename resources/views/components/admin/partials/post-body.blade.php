@php
    $currentPage = $posts->currentPage();
    $perPage = $posts->perPage();
    $startIndex = ($currentPage - 1) * $perPage + 1;
@endphp

@forelse ($posts as $index => $post)
    <x-admin.tr>
        <x-admin.td>{{ $startIndex + $index }}</x-admin.td>
        <x-admin.td>{{ Str::limit($post->title, 25) }}</x-admin.td>
        <x-admin.td> {{ $post->user->name }}</x-admin.td>
        <x-admin.td> {{ $post->created_at }}</x-admin.td>
        <x-admin.td> {{ $post->updated_at }}</x-admin.td>
        <x-admin.td>
            <div class="flex items-center justify-center space-x-2">
                <x-admin.action-buttons edit="{{ route('posts.edit', $post->slug) }}"
                    delete="{{ route('posts.destroy', $post->slug) }}" />
                <a href="{{ route('posts.show', $post->slug) }}"
                    class="text-sm font-medium text-green-600 dark:text-green-500 hover:underline">
                    Lihat
                </a>
            </div>
        </x-admin.td>

    </x-admin.tr>
@empty
    <x-admin.empty-row colspan="5" />
@endforelse
</tbody>
