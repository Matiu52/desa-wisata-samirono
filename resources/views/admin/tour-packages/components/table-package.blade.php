@php
    $currentPage = $tourPackages->currentPage();
    $perPage = $tourPackages->perPage();
    $startIndex = ($currentPage - 1) * $perPage + 1;
@endphp
<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400" id="table-tour-package">
    <thead class="text-xs text-white uppercase bg-blue-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-2 py-3">
                Nomor
            </th>
            <th scope="col" class="px-6 py-3">
                Judul Paket
            </th>
            <th scope="col" class="px-6 py-3">
                Deskripsi Paket
            </th>
            <th scope="col" class="px-6 py-3">
                Harga
            </th>
            <th scope="col" class="px-6 py-3">
                Daftar Kegiatan
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
            <th scope="col" class="px-12 py-3">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody id="post-table">
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
                    <td class="px-2 py-4">
                        {{ $startIndex + $index }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ Str::limit($tourPackage->package_name, 25) }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ Str::limit($tourPackage->description, 25) }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Rp {{ number_format($tourPackage->price, 0, ',', '.') }}
                    </th>
                    <th scope="row"
                        class="list-disc list-inside text-left px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @foreach ($tourPackage->listItems as $item)
                            <li>{{ $item->name }}</li>
                        @endforeach
                    </th>
                    <td class="px-6 py-4">
                        {{ $tourPackage->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $tourPackage->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $tourPackage->updated_at }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('tour-packages.edit', $tourPackage->slug) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                        </a>|
                        <a href="{{ route('tour-packages.show', $tourPackage->slug) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat
                        </a>
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
    </tbody>
</table>
<div class="m-3">
    {{ $tourPackages->appends(['keyword' => request()->get('keyword')])->links('vendor.pagination.tailwind') }}
</div>
