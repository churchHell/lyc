
    <div class="py-4 sm:py-2 w-full flex flex-col sm:flex-row justify-between items-center space-y-2 space-x-2">
        <div class="flex space-x-2 md:space-x-4 sm:w-1/2">
            <a href="{{ route('item.show', [$item['categories'][0]['slug'], $item['slug']]) }}" title="{{ $item['name'] }}">
                <img class='w-20 h-20 object-contain' src="{{ Storage::url($image) }}" alt="{{ $item['name'] }}" title="{{ $item['name'] }}">
            </a>
            <div class="">
                <a href="{{ route('item.show', [$item['categories'][0]['slug'], $item['slug']]) }}" title="{{ $item['name'] }}" class="font-bold">
                    {{ $item['name'] }}
                </a>                    
                <div class="">{{ renderPrice($price) }}</div>
                <div>
                    @if(!empty($item['properties']))
                    @foreach($item['properties'] as $property)
                    <div class="">
                        {{ $property['name'] }}: 
                        {{ $property['pivot']['value'] }} 
                        ({{ $property['unit']['name'] }}.)
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="space-x-8 flex flex-col sm:flex-row">
            <div class="flex flex-col space-y-2 items-center">
                <div class="flex items-start space-x-2">
                    <x-input wire:model.lazy="qty" class="s w-16 text-center"></x-input>
                    <x-button wire:click="update" success="updated" error="notUpdated"
                    class="s success" :disabled="empty($purchaseId)">{{ __('update') }}</x-button>
                </div>
                <div class="text-center">
                    @if($total_without_discount) <div class="line-through">{{ renderPrice($total_without_discount) }}</div> @endif
                    <div class="font-bold">{{ renderPrice($total) }}</div>
                    <div class="text-xs text-red-500">{{ __('cart-actual-time') }}</div>
                </div>
            </div>
            <div class="text-center">
                <div class="font-bold">{{ __('added') }}</div>
                <div class="">{{ $created }}</div>
            </div>
            <div class="">
                <x-button wire:click="delete" success="deleted" error="notDeleted"
                class="s danger" :disabled="empty($purchaseId)">{{ __('delete') }}</x-button>
            </div>
        </div>
    </div>
