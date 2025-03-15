@forelse ($setting as $set)
    @php
        $jumlahGambar = $set->images ? count(explode(',', $set->images)) : 0;
    @endphp
    <x-admin.tr>
        <x-admin.td>{{ $set->section }}</x-admin.td>
        <x-admin.td>{{ $set->title }}</x-admin.td>
        <x-admin.td>{{ Str::limit($set->content, 100, '...') }}</x-admin.td>
        <x-admin.td>{{ $jumlahGambar }}</x-admin.td>
        <x-admin.td>
            <x-admin.action-buttons edit="{{ route('home-settings.edit', $set) }}"
                delete="{{ route('home-settings.destroy', $set) }}" />
        </x-admin.td>
    </x-admin.tr>
@empty
    <x-admin.empty-row colspan="5" />
@endforelse
