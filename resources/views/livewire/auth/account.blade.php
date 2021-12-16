<div class="mx-auto">

    <div class="font-bold text-lg text-center">{{ __('account') }}</div>

    <form wire:submit.prevent="update" class="space-y-4">

        <x-input wire:model.delay.9999s='name' class="s"></x-input>
        <x-input wire:model.delay.9999s='surname' class="s"></x-input>
        <x-input wire:model.delay.9999s='phone' class="s"></x-input>

        <x-button class='s success' >{{ __('update') }}</x-button>

    </form>



</div>