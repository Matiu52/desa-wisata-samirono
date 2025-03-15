<div class="overflow-x-auto rounded-xl shadow-md">
    <div class="max-h-[450px] overflow-y-auto">
        <table class="min-w-full table-auto border-gray-300">
            <thead class="bg-gray-300 text-gray-700 text-sm font-semibold uppercase">
                {{ $head }}
            </thead>
            <tbody {{ $attributes->merge(['id' => $attributes->get('id')]) }} class="text-gray-700 text-sm">
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>
