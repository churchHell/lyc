<div class="space-y-1">
    <div class="grid grid-cols-12 gap-4">
            
        <div class="col-span-3">
            {{ $delivery['name'] }}
        </div>

        <div class="col-span-3">
            {{ $delivery['description'] }}
        </div>

        <div class="">
            {{ $delivery['price'] }}
        </div>

        <div class="space-x-2">
            <x-checkbox wire:click.prevent="activateFreePrice" cond="{{ $delivery['active_free_price'] }}" class="xs"></x-checkbox>
            {{ $delivery['free_price'] }}
        </div>

        <div class="col-span-3 flex justify-end items-start space-x-2">
            <x-checkbox wire:click.prevent="activate" cond="{{ $delivery['active'] }}" class="xs"></x-checkbox>
            <x-button wire:click="$set('edit', 'true')" class="xs warning">{{ __('edit') }}</x-button>
            <x-button wire:click="delete" class="xs danger">{{ __('delete') }}</x-button>
        </div>

    </div>

    @if($edit)
        <livewire:admin.deliveries.edit 
            :delivery="$delivery" 
            :key="'delivery-edit-'.$delivery['id']"
        />
    @endif

</div>
