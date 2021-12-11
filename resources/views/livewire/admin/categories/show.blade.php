<div class="flex space-y-1">

    <div class="px-1 w-1/12">{{ $category['id'] }}</div>

    <div class="px-1 w-1/4">
        @if(!$edit)
        <a href="{{ route('admin.items.index', $category['slug']) }}">{{ $name }}</a>
        @else
        <x-input wire:model.lazy="name" class="xs"></x-input>
        @endif
    </div>

    <div class="px-1 w-1/4">{{ $category['slug'] }}</div>

    <div class="px-1 space-x-1 w-1/3 flex">
        @if(!$edit)
            <x-button wire:click="$toggle('edit')" class="xs warning">{{ __('edit') }}</x-button>
        @else
            <x-button wire:click="update" class="xs success">{{ __('update') }}</x-button>
            <x-button wire:click="$set('edit', false)" class="xs danger">{{ __('cancel') }}</x-button>
        @endif
        <x-button wire:click="activate" class="xs {{ $category['active'] ? 'success' : 'danger' }}">{{ __('active') }}</x-button>
        @if($destroy)
            <livewire:confirm/>
        @else
            <x-button wire:click="$toggle('destroy')" class="xs danger">{{ __('delete') }}</x-button>
        @endif
    </div>

</div>