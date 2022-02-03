@extends('admin.layouts.app')

@section('admin-content')

    <div class="flex flex-col items-start divide-y">
        <a href="{{ route('admin.promocodes.create') }}" class="btn s success mb-4" title="{{ __('create') }}">{{ __('create') }}</a>
        <livewire:admin.promocode.index />
    </div>

@endsection

