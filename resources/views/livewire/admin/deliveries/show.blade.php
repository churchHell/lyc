<div class="space-y-1">
    <div class="grid grid-cols-6 gap-4">
            
        <div class="">
            {{ $delivery['name'] }}
        </div>

        <div class="col-span-2">
            {{ $delivery['description'] }}
        </div>

        <div class="">
            {{ $delivery['price'] }}
        </div>

        <div class="col-span-2 flex justify-end space-x-2">
            <x-checkbox wire:click.prevent="activate" cond="{{ $delivery['active'] }}" class="xs"></x-checkbox>
            <x-button wire:click="$set('edit', 'true')" class="xs warning">{{ __('edit') }}</x-button>
            <x-button wire:click="delete" class="xs danger">{{ __('delete') }}</x-button>
        </div>

    </div>

    @if($edit)
        <livewire:admin.deliveries.edit 
            :delivery="$delivery" 
            :key="'delivery-'.$delivery['id']"
        />
    @endif

</div>
