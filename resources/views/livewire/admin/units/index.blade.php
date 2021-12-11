<div class="pt-4 space-y-1">

    @forelse ($units as $unit)
        <div class="flex justify-between">
            <div>{{ $unit->name }}</div>
            <div>

                <x-button wire:click="delete({{ $unit->id }})" class="xs danger">{{ __('delete') }}</x-button>
                @error('error-'.$unit->id)<div class="text-xs text-red-800">{{$message}}</div>@enderror
            </div>
        </div>
    @empty
        {{ __('empty') }}
    @endforelse

</div>
