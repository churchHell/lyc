<div class="p-2 grid grid-cols-12 rounded shadow-md bg-{{$order['status']['color']}}-100">

    <div class="xs space-y-1">
        <div class="flex items-center space-x-1">
            <div class="font-bold">{{ $order['id'] }}</div>
            @if(!empty($order['payment_status']))
                    <i class="fas fa-coins xs {{ $order['payment_status']==2 ? 'success' : 'danger' }}" 
                        title="{{ __('alpha.status.'.$order['payment_status']) }}"
                    ></i>                
            @endif
            @if(!empty($order['payment_error']))
                <i class="fas fa-exclamation-triangle xs danger" title="{{ __('alpha.status.'.$order['payment_error']) }}"></i>
            @endif
            @if(!empty($order['payment_action_description']))
                <i class="fas fa-exclamation-triangle xs danger" title="{{ $order['payment_action_description'] }}"></i>
            @endif
        </div>
        <div>{{ $order['created'] }}</div>
        <div x-data="{ statuses:false }" class="space-y-1">
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

    <div class="xs col-span-2">
        <div>{{ $order['full_name'] }}</div>
        <div>{{ $order['phone'] }}</div>
    </div>

    <div class="xs col-span-2">
        <div class="">
            <select wire:model="order.delivery_id" class="xs border rounded pr-2 success w-full">
                @forelse ($deliveries as $delivery)
                    <option value="{{ $delivery['id'] }}" class="text-white bg-blueGray-800">
                        {{ $delivery['name'] }}:
                        {{ renderPrice($delivery['price']) }}
                    </option>
                @empty
                    {{ __('empty') }}
                @endforelse
            </select>
        </div>
        <div class="">
            @if($order['index']) {{ $order['index'] }}, @endif
            @if($order['city']) {{ $order['city'] }}, @endif
            @if($order['address']) {{ $order['address'] }}@endif
        </div>
    </div>

    <div class="xs flex flex-col col-span-4">
        @foreach($order['purchases'] as $purchase)
            <a href="{{ route('item.show', [$purchase['item']['categories'][0]['slug'], $purchase['item']['slug']]) }}">
                {{ $purchase['item']['name'] }}
                <span class="font-bold">({{ renderPrice($purchase['price']) }})</span>
                <span class="text-primary">[{{ $purchase['qty'] }}  {{ __('thing') }}]</span>
            </a>
        @endforeach
    </div>

    <div class="xs">
        {{ renderPrice($order['price']) }}
        <div class="font-bold">
            {{ renderPrice($order['price'] + $order['delivery']['price']) }}
        </div>
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

    

</div>