<x-admin.table>
    <x-slot name="head">
        <x-admin.th>Nomor</x-admin.th>
        <x-admin.th>Judul</x-admin.th>
        <x-admin.th>Dibuat Oleh</x-admin.th>
        <x-admin.th>Dibuat Pada</x-admin.th>
        <x-admin.th>Diupdate Pada</x-admin.th>
        <x-admin.th>Aksi</x-admin.th>
    </x-slot>
    <x-slot name="body">
        <tbody id="post-table">
            @include('components.admin.partials.post-body', ['posts' => $posts])
        </tbody>
    </x-slot>
</x-admin.table>

{{-- Pagination --}}
<div class="m-6">
    {{ $posts->appends(['keyword' => request()->get('keyword')])->links('vendor.pagination.tailwind') }}
</div>
