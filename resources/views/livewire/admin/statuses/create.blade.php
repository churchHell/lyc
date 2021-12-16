<div class="pb-4">
    <form wire:submit.prevent="store" class="flex space-x-2">
        <x-input wire:model.delay.500ms="name" class="s"></x-input>
        <div class='flex flex-col'>
            <select wire:model="color" class="s border rounded pr-2 bg-{{$color}}-100">
                <option value="" disabled>{{ __('color') }}</option>
                @foreach($colors as $color)
                    <option value="{{ $color }}" class="bg-{{$color}}-100">
                        {{ $color }}
                    </option>
                @endforeach
            </select>
            <x-error>color</x-error>
        </div>
        <x-button class="s success">{{ __('create') }}</x-button>    
    </form>
    <x-error>error</x-error>
</div>