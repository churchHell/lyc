<div>

    <x-button 
        wire:click="store"
        success="stored" 
        error="notStored" 
        class="s success whitespace-nowrap"
    >
        {{ __('tocart') }}
    </x-button>

</div>
