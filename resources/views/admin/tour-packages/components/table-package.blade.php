@php
    $currentPage = $tourPackages->currentPage();
    $perPage = $tourPackages->perPage();
    $startIndex = ($currentPage - 1) * $perPage + 1;
@endphp

<x-admin.table>
    <x-slot name="head">
        <x-admin.th>Nomor</x-admin.th>
        <x-admin.th>Judul Paket</x-admin.th>
        <x-admin.th>Deskripsi</x-admin.th>
        <x-admin.th>Harga</x-admin.th>
        <x-admin.th>Daftar Kegiatan</x-admin.th>
        <x-admin.th>Dibuat Oleh</x-admin.th>
        <x-admin.th>Dibuat Pada</x-admin.th>
        <x-admin.th>Diupdate Pada</x-admin.th>
        <x-admin.th>Aksi</x-admin.th>
    </x-slot>

    <x-slot name="body">
        @if ($tourPackages->isEmpty())
            <tr>
                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada data.
                </td>
            </tr>
        @else
            @foreach ($tourPackages as $index => $tourPackage)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">{{ $startIndex + $index }}</td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">
                        {{ $tourPackage->package_name }}
                    </td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">
                        {{ \Illuminate\Support\Str::limit($tourPackage->description, 50) }}

                    </td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">
                        Rp {{ number_format($tourPackage->price, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 overflow-hidden">
                        <ul class="list-disc pl-4">
                            @foreach ($tourPackage->listItems as $item)
                                <li class="whitespace-nowrap">{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">{{ $tourPackage->user->name }}</td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">{{ $tourPackage->created_at }}</td>
                    <td class="px-4 py-3 border-2 text-sm text-gray-700 text-center">{{ $tourPackage->updated_at }}</td>
                    <td class="px-4 py-3 space-y-1 flex flex-col items-center">
                        <a href="{{ route('tour-packages.edit', $tourPackage->slug) }}"
                            class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="{{ route('tour-packages.show', $tourPackage->slug) }}"
                            class="text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                        <form action="{{ route('tour-packages.destroy', $tourPackage->slug) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus paket ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </x-slot>
</x-admin.table>

{{-- Pagination --}}
<div class="m-6">
    {{ $tourPackages->appends(['keyword' => request()->get('keyword')])->links('vendor.pagination.tailwind') }}
</div>
