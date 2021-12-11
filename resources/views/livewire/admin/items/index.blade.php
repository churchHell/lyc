<div class="divide-y">
    @if($categories->count() > 0)
        <div class="flex justify-between py-2">
            <div x-data="{ open: false }" @click="open = true" class="">
                <x-button class="s {{ $categoryId ? 'success' : 'warning' }}">
                    {{ $categoryId ? $categories->get($categoryId)->name : __('category') }}
                </x-button>
                <div x-show="open" class="bg-gray-200 flex flex-col w-auto absolute rounded shadow">
                    @foreach ($categories as $category)
                        <a href="{{ route('admin.items.index') }}" class=""></a>
                        <div
                                wire:click="$set('categoryId', {{ $category->id }})"
                                @click.away="open = false"
                                class="xs hover:bg-primary hover:text-white"
                        >{{ $category->name }}</div>
                    @endforeach
                </div>
            </div>
            @if ($categoryId)
                <div class="">
                    <a href="{{ route('admin.items.create', [$categoryId]) }}" class="btn s success">{{ __('create') }}</a>
                </div>
            @endif
        </div>
    @endif

    @if ($items->count() > 0)
        <div class="py-2 space-y-1">
            @foreach ($items as $item)
                <livewire:admin.items.show :itemModel="$item" :categorySlug="$categories->get($categoryId)->slug" :key="'item-'.$item->id" />
            @endforeach
        </div>
    @endif

</div>
