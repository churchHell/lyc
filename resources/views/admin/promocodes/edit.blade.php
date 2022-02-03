@extends('admin.layouts.app')

@section('admin-content')

    <livewire:update :model="$promocode"
        :types="$types"
        styles="flex-col space-y-2 s"
    />

@endsection

