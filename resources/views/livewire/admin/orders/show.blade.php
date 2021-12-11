<div class="p-2 grid grid-cols-12 rounded shadow-md bg-{{$order['status']['color']}}-100">

    <div class="xs">
        {{ $order['id'] }}
    </div>

    <div class="xs col-span-2">
        <div>{{ $order['full_name'] }}</div>
        <div>{{ $order['phone'] }}</div>
    </div>

    <div class="xs">
        {{ $order['delivery']['name'] }}
    </div>

    <div class="xs flex flex-col col-span-4">
        @foreach($order['purchases'] as $purchase)
            <a href="{{ route('item.show', [$purchase['item']['categories'][0]['slug'], $purchase['item']['slug']]) }}">
                {{ $purchase['item']['name'] }}
            </a>
        @endforeach
    </div>

    <div class="xs">
        {{ renderPrice($order['price']) }}
    </div>

    <div wire:click="$set('commentEdit', true)" class="xs col-span-2 cursor-pointer">
        @if (!$commentEdit)
            {{$order['comment']}}
        @else
            <form wire:submit.prevent="updateComment" wire:keydown.escape="$set('commentEdit', false)">
                <x-input wire:model.delay.9999s="order.comment" class="xs"></x-input>
            </form>
        @endif

    </div>

    <div x-data="{ statuses:false }" class="xs space-y-1">
        <x-button @click="statuses=!statuses" @click.away="statuses=false"
                  class="xs success">{{ $order['status']['name'] }}</x-button>
        <div x-show="statuses" class="absolute space-y-1 bg-red-200" style="display: none;">
            @foreach(Arr::except($statuses, [$order['status']['id']]) as $status)
                <x-button wire:click="status({{$status['id']}})" success="" error=""
                          class="xs danger">{{ $status['name'] }}</x-button>
            @endforeach
        </div>
    </div>

</div>