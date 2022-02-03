<div class="space-y-2 livewire-create">

    <form wire:submit.prevent='store' class="flex {{ $styles }}">

        @foreach($fields as $name => $value)

            <div class="flex items-center space-x-2">

                <span class='w-1/6'>{{ __($name) }}:</span>

                <x-input wire:model.delay.99999s='fields.{{ $name }}' 
                    class="{{ $size }} w-full"
                    placeholder="{{ __($name) }}"    
                    type="{{ data_get($types, $name) }}"
                ></x-input> 

            </div>            
               
        @endforeach
        
        <x-button wire:target='update' class="success {{ $size }}" icon="check">{{ __('create') }}</x-button>

    </form>

    <x-success></x-success>

</div>