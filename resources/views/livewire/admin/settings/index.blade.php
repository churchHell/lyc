<div class="flex flex-col space-y-1">
    @foreach($settings as $id => $setting)
    <div class="flex flex-col">
        <div class="space-x-8">
            <div>{{ $setting['name'] }}</div>
            <div class="flex space-x-2">
                {{ $setting['type']['slug']}}
                @if($setting['type']['slug'] == 'textarea')
                    <x-trix wire:model="settings.{{ $setting['id'] }}.value"></x-trix>
                @else
                    <input wire:model.lazy="settings.{{ $setting['id'] }}.value" type="{{ $setting['type']['slug'] }}" class="xs">
                @endif
                
                <x-button wire:click="update({{ $setting['id'] }})" class="xs success">{{ __('update') }}</x-button>
            </div>
        </div>
        <div>@error("settings.{{$setting['id']}}.value"){{ $message }}@enderror</div>
    </div>
    @endforeach
</div>
