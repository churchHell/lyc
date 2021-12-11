@props(['name' => null, 'type' => 'text'])

<div class="flex flex-col">

    <span>{{ __($name ?? $attributes->wire('model')->value) }}:</span>

    <x-input 
        {{ $attributes }}
        type="{{ $type }}" 
        placeholder="{{ __($name) }}" 
        name="{{ $name }}"
        required 
        autofocus
    ></x-input>

</div>