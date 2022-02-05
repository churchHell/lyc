<div class="flex-space-y-2">

    <div class="grid grid-cols-12 px-2 py-3">
        <div class="xs col-span-1">
            {{ $promocode->code }}
            <a href="{{ route('admin.promocodes.edit', $promocode->id) }}" class="">
                <i class="fas fa-pen"></i>
            </a>
        </div>       
        <div class="xs col-span-1">{{ $promocode->description }}</div>
        <div class="xs col-span-1">{{ $promocode->min_price }}</div>
        <div class="xs col-span-1">{{ $promocode->min_qty }}</div>
        <div class="xs col-span-1">{{ $promocode->every_item }}</div>
        <div class="xs col-span-1">{{ $promocode->percentage_discount }}</div>
        <div class="xs col-span-1">{{ $promocode->fixed_discount }}</div>
        <div class="xs col-span-1">{{ $promocode->free_delivery }}</div>
        <div class="xs col-span-1">{{ $promocode->gift_item_id }}</div>
        <div class="xs col-span-1">{{ $promocode->starts_at }}</div>
        <div class="xs col-span-1">{{ $promocode->ends_at }}</div>
        <div class="xs col-span-1">{{ $promocode->active }}</div>
   </div>

</div>
