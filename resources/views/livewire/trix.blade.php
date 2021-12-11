<div
    wire:ignore
    {{ $attributes }}
    x-data="{value:@entangle('description')}"
    x-init="$refs.trix.editor.loadHTML(value)"
    @trix-blur="$dispatch('change', $event.target.value)"
>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

    <input id="x" type="hidden">
    <trix-editor x-ref="trix" input="x"></trix-editor>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>


@if(false)
    <form …>
        <input id="{{$trixId}}" value="{{$value}}" type="hidden" name="content">
        <trix-editor input="{{$trixId}}"></trix-editor>
    </form>
@endif

</div>


