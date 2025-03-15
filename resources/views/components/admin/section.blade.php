@props(['title'])

<section class="space-y-6">
    <div class="border-b border-gray-300 pb-2 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-black tracking-tight">
            {{ $title }}
        </h2>
    </div>
    <div class="space-y-4">
        {{ $slot }}
    </div>
</section>
