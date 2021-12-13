<div class="space-y-4">

    <form wire:submit.prevent="render" class="flex space-x-2">
        <x-input wire:model="search" wire:keydown.delay.1s="render" class="s w-full"></x-input>
        <button type="submit" class="s success">{{ __('search') }}</button>
    </form>

    <div class="flex flex-wrap items-center divide-y md:divide-none">

        @forelse ($items as $item)
            <div class="px-4 py-4 md:pb-4 m-auto w-72">
                <a href="{{ route('item.show', [$item->categories->first()->slug, $item->slug]) }}" class="">
                    <img class='h-72 object-cover m-auto' src="{{ Storage::url($item->image->path) }}"
                         alt="{{ $item->name }}" title="{{ $item->name }}">
                </a>
                <div class="flex justify-between space-x-2 mt-2">
                    <div class="space-y-2">
                        <a href="{{ route('item.show', [$item->categories->first()->slug, $item->slug]) }}"
                           class="font-bold">{{ $item->name }}</a>
                        <div class="">
                            {{ __('price') }}: {{ renderPrice($item->price) }}
                        </div>
                        @if(!empty($item->properties))
                            <div class="">
                                @foreach($item->properties as $property)
                                    <div class="">
                                        {{ $property->name }}:
                                        {{ $property->pivot->value }}
                                        ({{ $property->unit->name }}.)
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="">
                            {{ __('available') }}: {{ renderQty($item->qty) }}
                        </div>
                    </div>

                    <livewire:cart.create :item="$item" :key="'cart-create-'.$item->id"/>

                </div>
            </div>
        @empty
            {{ __('empty') }}
        @endforelse

    </div>

    @if($items->count() > 0)
        {{ $items->links() }}
    @endif

</div>
