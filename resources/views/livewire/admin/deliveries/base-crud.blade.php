<div class="space-y-2">
    
    <form wire:submit.prevent="{{ $submit }}" class="flex justify-between">
        <x-input wire:model.delay.9999s="name" class="{{ $class }}"></x-input>
        <x-input wire:model.delay.9999s="description" class="{{ $class }}"></x-input>
        <x-input wire:model.delay.9999s="price" class="{{ $class }}"></x-input>
        <div class="space-x-4">
            <x-button type='submit' class="{{ $class }} success">{{ __($button) }}</x-button>
            @yield('append')
        </div>
    </form>    

</div>
