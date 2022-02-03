<div class="space-y-2 livewire-edit">

    <form wire:submit.prevent='update' class="flex {{ $styles }}">

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
        
        <x-button wire:target='update' class="success {{ $size }}" icon="check">{{ __('update') }}</x-button>

    </form>

    <x-success></x-success>

</div>
