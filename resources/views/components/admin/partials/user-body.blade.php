@php
    $page = request()->get('page', 1);
    $perPage = 10;
    $offset = ($page - 1) * $perPage;
@endphp
@forelse ($users as $index => $user)
    <x-admin.tr>
        <x-admin.td>{{ $offset + $index + 1 }}</x-admin.td>
        <x-admin.td>{{ $user->name }}</x-admin.td>
        <x-admin.td>{{ $user->email }}</x-admin.td>
        <x-admin.td>{{ $user->created_at->format('d M Y') }}</x-admin.td>
        <x-admin.td>{{ $user->role->name }}</x-admin.td>
        <x-admin.td>
            <x-admin.action-buttons edit="{{ route('user.edit', $user) }}" delete="{{ route('user.destroy', $user) }}" />
        </x-admin.td>
    </x-admin.tr>
@empty
    <x-admin.empty-row colspan="5" />
@endforelse
