<div class="pb-4 space-x-4">

    <x-input wire:model="name" class="s"></x-input>

    <select wire:model="unit_id" class="s border rounded pr-2">
        <option value="">{{ __('units') }}</option>
        @forelse ($units as $unit)
            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @empty
            {{ __('empty') }}
        @endforelse
    </select>

    <x-button wire:click="store" class="s success">{{ __('create') }}</x-button>

    <x-error>stored</x-error>
    <x-error>unit_id</x-error>

</div>
