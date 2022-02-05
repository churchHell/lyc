<div class="">
    
    @if (!$confirm)
        <x-button wire:click.prevent="delete" class="danger xs"></x-button>    
    @else
        <livewire:confirm />
    @endif
    
</div>
