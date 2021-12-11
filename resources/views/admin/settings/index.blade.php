@extends('admin.layouts.app')

@section('admin-content')

    <div class="space-y-1">
        @foreach($settings as $setting)
            <livewire:admin.settings.edit :settingModel="$setting" :key="'setting-'.$setting->id" />
        @endforeach
    </div>

@endsection
