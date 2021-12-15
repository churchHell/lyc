<div>

    <form wire:submit.prevent="update" class="flex justify-between">
        <x-input wire:model.delay.9999s="user.name" class="s"></x-input>
        <x-input wire:model.delay.9999s="user.surname" class="s"></x-input>
        <x-input wire:model.delay.9999s="user.phone" class="s"></x-input>
        <x-input wire:model.delay.9999s="user.email" class="s"></x-input> 
        <x-button type='submit' class="s success">{{ __('update') }}</x-button>
    </form> 

</div>
