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