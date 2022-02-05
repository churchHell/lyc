@php
    $key = !empty($slot->toHtml()) ? $slot->toHtml() : 'success';
@endphp

@if(session()->has($key))
    <span class="success shadow-md text-xs xs">
        {{ session($key) }}
    </span>
@endif