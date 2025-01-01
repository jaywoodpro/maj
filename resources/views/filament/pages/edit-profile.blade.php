<x-filament::page>
    <div class="p-6 bg-blend-color shadow rounded-lg">
        <form wire:submit.prevent="save" class="space-y-6">
            {{ $this->form }}
            <x-filament::button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white">
                ذخیره تغییرات
            </x-filament::button>
        </form>
    </div>
</x-filament::page>
