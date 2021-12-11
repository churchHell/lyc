<div class="pt-4">

    @forelse ($properties as $property)
        <div class="flex space-y-1 space-x-2">
            <div class="w-5/12">{{ $property->name }}</div>
            <div class="w-2/12">{{ $property->unit->name }}</div>
            <div class="w-5/12 flex justify-end">
                <x-button wire:click="delete({{$property->id}})" class="xs danger">{{ __('delete') }}</x-button>
            </div>
        </div>
    @empty
        {{ __('empty') }}
    @endforelse

</div>
