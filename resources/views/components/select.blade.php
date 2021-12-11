<div
    x-data="{ open : false }"
    @click.away="open=false"
>

    <x-button
        @click="open=!open"
        class="s warning"
    >
        {{__('select')}}
    </x-button>

    <div
        class="absolute bg-gray-100"
        x-show="open"
        style="display: none;"
    >

        {{ $slot }}
        
    </div>

</div>
