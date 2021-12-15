<div class="space-y-2">
    
    <form wire:submit.prevent="{{ $submit }}" class="flex justify-between">
        <x-input wire:model.delay.9999s="name" class="{{ $class }}"></x-input>
        <x-input wire:model.delay.9999s="description" class="{{ $class }}"></x-input>
        <x-input wire:model.delay.9999s="price" class="{{ $class }}"></x-input>
        <div class="flex space-x-2">
            <x-checkbox prop="active_free_price" cond="{{ $active_free_price }}" class="{{ $class }}">active</x-checkbox>
            <x-input wire:model.delay.9999s="free_price" class="{{ $class }}"></x-input>
        </div>
        <div class="space-x-4">
            <x-button type='submit' class="{{ $class }} success">{{ __($button) }}</x-button>
            @yield('append')
        </div>
    </form>    

</div>
