<div class="pb-4">
    <x-input wire:model="name" class="s"></x-input>
    <x-button wire:click="store" class="s success">{{ __('create') }}</x-button>
    <x-error>stored</x-error>
</div>
