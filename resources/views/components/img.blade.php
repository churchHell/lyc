@props(['path', 'name' => ''])

<img 
    {{ $attributes->merge(['class' => '']) }} 
    src="{{ Storage::url($path) }}" 
    alt="{{ $name }}" 
    title="{{ $name }}"
>