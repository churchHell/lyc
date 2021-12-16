<div class="space-y-4">
        <div class="grid grid-cols-12 gap-4 rounded shadow-lg text-white bg-blueGray-800 px-2 py-3">
                <div class="xs col-span-3">{{ __('name') }}</div>
                <div class="xs col-span-3">{{ __('description') }}</div>
                <div class="xs">{{ __('price') }}</div>
                <div class="xs col-span-2">{{ __('free_delivery') }}</div>
                <div class="xs col-span-3">{{ __('actions') }}</div>
        </div>
        <div class="space-y-1">
    @forelse($deliveries as $delivery)
        <livewire:admin.deliveries.show
            :deliveryModel="$delivery" 
            :key="'delivery-'.$delivery->id" 
        />
    @empty
        {{ __('empty') }}
    @endforelse
        </div>
</div>