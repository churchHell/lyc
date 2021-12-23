@error($slot->toHtml())
    <div {{ $attributes->merge(['class' => "text-xs text-red-800"]) }}>
        {!! $message !!}
    </div>
@enderror