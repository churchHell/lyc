<div class="w-full py-4 space-y-1">
    
    @foreach($pages as $page)
        <div class="flex justify-between items-center">
            <div>{{ $page->name }}</div>
            <div class="">
                <x-checkbox wire:click.prevent="activate({{ $page->id }})" cond="{{ $page->active }}"></x-checkbox>
                <a href="{{ route('admin.pages.edit', [$page->id]) }}" class="s warning">{{ __('edit') }}</a>
                <x-button wire:click="delete({{$page->id}})" class="s danger">{{ __('delete') }}</x-button>
            </div>
        </div>
    @endforeach

</div>
