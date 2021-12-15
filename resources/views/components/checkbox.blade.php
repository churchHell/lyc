@props(['prop' => 'active', 'cond'])

<button 
    {{ $attributes->wire('click') }}
    wire:click.prevent="$toggle('{{$prop}}')"
    {{ $attributes->merge(['class' => " ".((bool)$cond ? 'success' : 'danger')]) }}
>

    {{ __(!empty($slot->toHtml()) ? $slot->toHtml() : Arr::last(explode('.', $prop))) }}

</button>