<div>
    
    <form wire:submit.prevent="{{ $pageId ? 'update' : 'store' }}" class="flex flex-col items-start space-y-4">
        <div class="flex flex-col space-y-1">
            <div class="">{{ __('name') }}</div>
            <x-input wire:model.lazy="name" class="s"></x-input>
        </div>
        <div class="flex flex-col space-y-1">
            <div class="">{{ __('content') }}</div>
            <x-trix wire:model="content"></x-trix>
        </div>
        <x-checkbox cond="{{$active}}"></x-checkbox>
        <x-button 
            type="submit" 
            wire:target="{{ $pageId ? 'update' : 'create' }}" 
            class="s success"
        >
            {{ __($pageId ? 'update' : 'create') }}
        </x-button>
    </form>

</div>
