@props(['title', 'count', 'desc' => ''])

<div class="bg-white border-2 border-gray-400 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
    <div class="text-4xl font-extrabold text-indigo-700">
        {{ $count }}
    </div>
    <div class="mt-1 text-black font-semibold text-lg">
        {{ $title }}
    </div>
    @if ($desc)
        <div class="mt-2 text-sm text-gray-700">
            {{ $desc }}
        </div>
    @endif
</div>
