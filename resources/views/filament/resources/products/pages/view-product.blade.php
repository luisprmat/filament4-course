<x-filament-panels::page>
    <div class="flex flex-col gap-4">
        <h1 class="text-2xl font-bold">{{ __('View :name', ['name' => __('product')]) }}</h1>
        <p>
            {{ $this->record->name }}
        </p>
    </div>
</x-filament-panels::page>
