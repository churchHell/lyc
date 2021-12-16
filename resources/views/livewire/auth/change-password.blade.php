<div class="mx-auto">

    <div class="font-bold text-lg text-center">{{ __("update") }} {{ __("password") }}</div>

    <form wire:submit.prevent="update" class="space-y-4">

        <x-input wire:model.delay.9999s='password' type="password" class="s"></x-input>
        <x-input wire:model.delay.9999s='new_password' type="password" class="s"></x-input>
        <x-input wire:model.delay.9999s='new_password_confirmation' type="password" class="s"></x-input>

        <x-button class='s success' >{{ __('update') }}</x-button>

    </form>

</div>