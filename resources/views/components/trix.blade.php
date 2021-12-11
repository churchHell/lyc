@props(['key' => 'uniqueKey'])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

<div wire:ignore>
    <trix-editor
        {{$attributes->whereDoesntStartWith('wire:model')}}
        x-data
        x-on:trix-change="$dispatch('input', event.target.value)"
        x-ref="trix"
        wire:model.debounce.999999s="{{$attributes->wire('model')->value}}"
        wire:key="{{$key}}"
    ></trix-editor>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>