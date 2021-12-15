<div class="space-y-4">
    <div class="grid grid-cols-9 rounded shadow-lg text-white bg-blueGray-800 px-2 py-3">
        <div class="xs">#</div>
        <div class="xs col-span-2">{{ __('name') }}</div>
        <div class="xs">{{ __('phone') }}</div>
        <div class="xs col-span-2">{{ __('email') }}</div>
        <div class="xs">{{ __('role') }}</div>
        <div class="xs col-span-2">{{ __('actions') }}</div>
    </div>

    <div class="space-y-1">
        @forelse($users as $user)
            <livewire:admin.users.show 
                :userModel="$user" 
                :roles="$roles" 
                :key="'user-'.$user->id" 
            />
        @empty
            {{ __('empty') }}
        @endforelse
    </div>
</div>
