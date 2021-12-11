<div class="flex justify-between">
    <div class="flex space-x-2">
        <img class="h-20 w-20 object-cover" src="{{ Storage::url($item['image']['path']) }}"
             title="{{ $item['name'] }}"
             alt="{{ $item['name'] }}">
        <div class="flex flex-col space-y-1">
            <a href="{{ route('item.show', [$categorySlug, $item['slug']]) }}"
               title="{{ $item['name'] }}">{{ $item['name'] }}</a>
            <div>{{ __('price') }}: {{ renderPrice($item['price']) }}</div>
            <div>{{ __('qty') }}: {{ $item['qty'] }}</div>
        </div>
    </div>
    <div class="space-x-1">
        <x-checkbox wire:click="activate" cond="{{$active}}"></x-checkbox>
        <a href="{{ route('admin.items.edit', [$item['id']]) }}"
           class="btn s success">{{ __('edit') }}</a>
        {{--                        <x-button wire:click="update({{ $item->id }})" class="s success">{{ __('edit') }}</x-button>--}}
        <x-button wire:click="delete({{ $item['id'] }})" class="s danger">{{ __('delete') }}</x-button>
    </div>
</div>