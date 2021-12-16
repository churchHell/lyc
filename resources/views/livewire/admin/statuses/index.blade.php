<div class="pt-4 space-y-4">

    <div class="grid grid-cols-6 gap-4 rounded shadow-lg text-white bg-blueGray-800 px-2 py-3">
        <div class="xs col-span-2">{{ __('name') }}</div>
        <div class="xs col-span-3">{{ __('color') }}</div>
        <div class="xs col-span-1">{{ __('actions') }}</div>
    </div>

    <div class="space-y-1">
        @forelse ($statuses as $status)
            <livewire:admin.statuses.show 
                :statusModel="$status" 
                :key="'status-show-'.$status->id" 
            />
        @empty
            {{ __('empty') }}
        @endforelse
    </div>

</div>