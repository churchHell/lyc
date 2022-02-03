@props(['name' => null])

<div class="flex flex-col {{ $attributes->onlyClasses(['w-full']) }}">
        <input
                type="{{ $attributes->type() }}"
                {{ $attributes->whereStartsWith(['wire:model']) }}
                placeholder="{{ $attributes->placeholder() }}"
                class="{{ $attributes->onlyClasses(['w-', 's', 'xs', 'm', 'text']) }}"
                name="{{ $name }}"                
        >

        @error(!empty($name) ? $name : $attributes->prop('model'))
            <div class="text-xs text-red-800">
                {{ $message }}
            </div>
        @enderror
</div>