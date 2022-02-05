<div class="flex-space-y-2">

    <div class="grid grid-cols-9 px-2 py-3">
        <div class="xs col-span-1">
            {{ $promocode->code }}            
        </div>       
        <div class="xs col-span-1">{{ $promocode->description }}</div>
        <div class="xs col-span-1">{{ $promocode->min_price }}</div>
        {{-- <div class="xs col-span-1">{{ $promocode->min_qty }}</div> --}}
        <div class="xs col-span-1">{{ $promocode->every_item }}</div>
        <div class="xs col-span-1">{{ $promocode->percentage_discount }}</div>
        {{-- <div class="xs col-span-1">{{ $promocode->fixed_discount }}</div> --}}
        {{-- <div class="xs col-span-1">{{ $promocode->free_delivery }}</div> --}}
        <div class="xs col-span-1">{{ $promocode->gift_item_id }}</div>
        <div class="xs col-span-1">
            <div class="">{{ __('starts_at') }}: {{ $promocode->starts_at }}</div>
            <div class="">{{ __('ends_at') }}: {{ $promocode->ends_at }}</div>
        </div>
        <div class="xs col-span-1">{{ $promocode->active }}</div>
        <div class="xs col-span-1 space-y-1">
            <a href="{{ route('admin.promocodes.edit', $promocode->id) }}" class="success xs">
                {{  __('edit') }}
            </a>
            <livewire:delete :model="$promocode"
                :key="'delete-'.$promocode->id"
            />
        </div>
   </div>

</div>
