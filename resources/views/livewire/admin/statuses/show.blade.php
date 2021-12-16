<div class="space-y-1">

    <div class="grid grid-cols-6 gap-4">

        <div class='col-span-2'>{{ $status['name'] }}</div>

        <div class="col-span-3 bg-{{$status['color']}}-100 xs rounded shadow">{{ $status['color'] }}</div>

        <div class='col-span-1 space-x-2'>
            <x-button 
                wire:click="delete" 
                class="xs danger"
            >
                {{ __('delete') }}
            </x-button>
        </div>

    </div>

    <x-error class='w-full text-center'>error</x-error>

</div>