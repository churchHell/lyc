<div>
    <div class="flex space-x-4">
        <div class="w-1/6">{{ $setting['name'] }}</div>
        <div class="flex items-start space-x-2">
            @if($setting['type']['slug'] == 'textarea')
                <div><x-trix wire:model="setting.value" class="xs"></x-trix></div>
            @else
                <input wire:model.lazy="setting.value" type="{{ $setting['type']['slug'] }}" class="xs">
            @endif
            <x-button wire:click="update" class="xs success">{{ __('update') }}</x-button>
        </div>
    </div>
    <div>@error("setting.value"){{ $message }}@enderror</div>
</div>
