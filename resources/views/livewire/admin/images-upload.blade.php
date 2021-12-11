<div class="space-y-4">

    <input type="file" wire:model="images" multiple>
    @error('images.*') <span class="error">{{ $message }}</span> @enderror

    @if (count($images) > 0)
        <div class="flex space-x-8">
            @foreach ($images as $key => $image)
                <div class="flex space-x-1">
                    <img class="w-20 h-20" src="{{ $image->temporaryUrl() }}">
                    <x-button wire:click="delete({{ $key }})" success="" error="" class="xs danger">{{ __('delete') }}</x-button>
                </div>
            @endforeach
        </div>
        <x-button wire:click="upload" class="s success"></x-button>
    @endif

</div>
