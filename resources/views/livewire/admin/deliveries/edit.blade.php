@extends('livewire.admin.deliveries.base-crud', [
    'submit' => 'update',
    'button' => 'update',
    'class' => 'xs'
])

@section('append')

    <x-button wire:click.prevent="$emit('editClose')" class="xs warning">{{ __('cancel') }}</x-button>

@endsection