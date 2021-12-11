@props(['name' => null])

<input
        {{ $attributes->whereStartsWith(['wire:model']) }}
        placeholder="{{ $attributes->placeholder() }}"
        class="{{ $attributes->onlyClasses(['w-', 's', 'm', 'text']) }}"
        name="{{ $name }}"
        {{ $attributes }}
>

@error(!empty($name) ? $name : $attributes->prop('model'))
<span class="text-xs text-red-800">
        {{ $message }}
    </span>
@enderror