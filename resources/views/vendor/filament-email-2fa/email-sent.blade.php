<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="save">
        <span class="text-gray-500 text-sm">
            @if ($this->getUser() && $this->getUser()->email)
                @lang('filament-email-2fa::filament-email-2fa.email_sent', ['email' => $this->getUser()->email])
            @else
                <span class="text-red-500">ایمیل کاربر پیدا نشد.</span>
            @endif
        </span>
        @if (session()->has('resent-success'))
            <span class="alert text-green-500  text-sm">
                {{ session('resent-success') }}
            </span>
        @endif

        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getFormActions()" :full-width="$this->hasFullWidthFormActions()" />

    </x-filament-panels::form>
</x-filament-panels::page.simple>
