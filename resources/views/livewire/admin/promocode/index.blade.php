<div class="flex flex-col space-y-2">
    @if($promocodes->count())

    <div class="grid grid-cols-9 rounded shadow-lg text-white bg-blueGray-800 px-2 py-3">
         <div class="xs col-span-1">{{ __('code') }}</div>       
         <div class="xs col-span-1">{{ __('description') }}</div>
         <div class="xs col-span-1">{{ __('min_price') }}</div>
         {{-- <div class="xs col-span-1">{{ __('min_qty') }}</div> --}}
         <div class="xs col-span-1">{{ __('every_item') }}</div>
         <div class="xs col-span-1">{{ __('percentage_discount') }}</div>
         {{-- <div class="xs col-span-1">{{ __('fixed_discount') }}</div> --}}
         {{-- <div class="xs col-span-1">{{ __('free_delivery') }}</div> --}}
         <div class="xs col-span-1">{{ __('gift_item_id') }}</div>
         <div class="xs col-span-1">{{ __('starts_at') }}/{{ __('ends_at') }}</div>
         <div class="xs col-span-1">{{ __('active') }}</div>
         <div class="xs col-span-1">{{ __('actions') }}</div>
    </div>

        @foreach($promocodes as $promocode)
            <livewire:admin.promocode.show :promocode="$promocode" :key="'promocode-show-'.$promocode->id" />
        @endforeach
        
    @else
        {{ __('empty') }}
    @endif
    
</div>
