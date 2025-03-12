@php
    $currentPage = $posts->currentPage();
    $perPage = $posts->perPage();
    $startIndex = ($currentPage - 1) * $perPage + 1;
@endphp
<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400" id="table-post">
    <thead class="text-xs text-white uppercase bg-blue-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-0 py-3">
                Nomor
            </th>
            <th scope="col" class="px-6 py-3">
                Judul
            </th>
            <th scope="col" class="px-6 py-3">
                Dibuat Oleh
            </th>
            <th scope="col" class="px-6 py-3">
                Dibuat Pada
            </th>
            <th scope="col" class="px-6 py-3">
                Diupdate Pada
            </th>
            <th scope="col" class="px-6 py-3">

            </th>
        </tr>
    </thead>
    <tbody id="post-table">
        @foreach ($posts as $index => $post)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-2 py-4">
                    {{ $startIndex + $index }}
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ Str::limit($post->title, 25) }}
                </th>
                <td class="px-6 py-4">
                    {{ $post->user->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->created_at }}
                </td>
                <td class="px-6 py-4">
                    {{ $post->updated_at }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('posts.edit', $post->slug) }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                    </a>|
                    <a href="{{ route('posts.show', $post->slug) }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="m-3">
    {{ $posts->appends(['keyword' => request()->get('keyword')])->links('vendor.pagination.tailwind') }}
</div>
