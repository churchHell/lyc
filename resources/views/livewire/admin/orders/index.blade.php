<div class="flex flex-col space-y-4">

    <div class="flex space-x-4 pb-4">
        <x-input-block wire:model="filters.name" name="name" class="s"></x-input-block>
        <x-input-block wire:model="filters.phone" name="phone" class="s"></x-input-block>
    </div>

    <div class="grid grid-cols-12 rounded shadow-lg text-white bg-blueGray-800 px-2 py-3">
        <div class="xs ">#</div>
        <div class="xs col-span-2">{{ __('name') }}</div>
        <div class="xs col-span-2">{{ __('delivery') }}</div>
        <div class="xs col-span-4">{{ __('items') }}</div>
        <div class="xs ">{{ __('price') }}</div>
        <div class="xs col-span-2">{{ __('comment') }}</div>
    </div>

    <div class="space-y-1">
        @forelse($orders as $order)

            <livewire:admin.orders.show 
                    :orderModel="$order" 
                    :deliveries="$deliveries"
                    :allStatuses="$statuses" 
                    :key="'order-'.$order->id" />

        @empty
         {{ __('empty') }}
        @endforelse
    </div>

</div>
