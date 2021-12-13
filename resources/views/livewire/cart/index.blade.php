<div class="w-full space-y-4">

    <div class="divide-y sm:divide-none">
        @forelse($cart->purchases as $purchase)

            <livewire:cart.show :purchase="$purchase" :key="'purchase-'.$purchase->id"/>

        @empty
            {{ __('empty') }}
        @endforelse
    </div>

    <hr>

    @if($deliveryPrice)
        <div class="flex justify-end">
            <div>
                {{ __('delivery') }}: {{ renderPrice($deliveryPrice) }}
            </div>
        </div>
    @endif

    <div class="flex justify-end">
        <div>
            {{ __('sum') }}: {{ renderPrice($cart->price + ($deliveryPrice ?? 0)) }}

        </div>
    </div>

    <hr>

    @if($orderCreated)
        <div class="m success">
            {{ $settings['created']['value'] }}
        </div>
    @endif

    @if($cart->purchases->count())
    <livewire:order.create/>
    @endif

</div>
