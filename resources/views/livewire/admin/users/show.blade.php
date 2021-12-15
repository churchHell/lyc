<div class="space-y-1">
    
    <div class="grid grid-cols-9">

        <div class="xs">
            {{ $user['id'] }}
        </div>
        <div class="xs col-span-2">
            {{ $user['full_name'] }}
        </div>
        <div class="xs">
            {{ $user['phone'] }}
        </div>
        <div class="xs col-span-2">
            {{ $user['email'] }}
        </div>
        <div class="xs">
            <select wire:model="user.role_id" class="xs border rounded pr-2 success">
                @forelse ($roles as $role)
                    <option value="{{ $role['id'] }}" class="text-white bg-blueGray-800">{{ $role['name'] }}</option>
                @empty
                    {{ __('empty') }}
                @endforelse
            </select>
        </div>
        <div class="xs col-span-2 space-x-1">
            <x-button wire:click="$toggle('edit')" class="xs warning">{{ __('edit') }}</x-button>
            <x-button wire:click="delete" class="xs danger">{{ __('delete') }}</x-button>
        </div>

    </div>

    @if($edit)
        <livewire:admin.users.edit :user="$user" :key="'user-edit-'.$user['id']" />
    @endif

</div>