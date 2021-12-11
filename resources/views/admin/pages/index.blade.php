@extends('admin.layouts.app')

@section('admin-content')

    <div class="flex flex-col items-start divide-y">
        <a href="{{ route('admin.pages.create') }}" class="btn s success mb-4" title="{{ __('create') }}">{{ __('create') }}</a>
        <livewire:admin.pages.index/>
    </div>

@endsection

