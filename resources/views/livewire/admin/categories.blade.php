<div
    x-data="{ categories : false }"
    @click.away="categories=false"
>

    <x-button
        @click="categories=!categories"
        class="s warning"
    >
        {{__('select')}}
    </x-button>

    <div
        class="absolute bg-gray-100"
        x-show="categories"
        style="display: none;"
    >
        @foreach($categories as $category)
            <div
                wire:click="add({{$category['id']}})"
                class="s hover:bg-primary hover:text-white cursor-pointer"
            >
                {{$category['name']}}
            </div>
        @endforeach
    </div>

</div>
