   
<div
    wire:ignore
    {{ $attributes }}
    x-data="{value:@entangle('description')}"
    x-init="$refs.trix.editor.loadHTML(value)"
    x-on:trix-change="value = $event.target.value"
>


    <input id="x" type="hidden" name="content">
    <trix-editor x-ref="trix" input="x"></trix-editor>

    <script>
        var trixEditor = document.getElementById("x")

        addEventListener("trix-blur", function(event) {
            @this.set('description', trixEditor.getAttribute('value'))
        })
    </script>

    


@if(false)
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <form …>
        <input id="{{$trixId}}" value="{{$value}}" type="hidden" name="content">
        <trix-editor input="{{$trixId}}"></trix-editor>
    </form>
    <script>
        var trixEditor = document.getElementById("x")

        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endif

</div>


