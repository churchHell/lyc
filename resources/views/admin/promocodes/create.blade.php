@extends('admin.layouts.app')

@section('admin-content')

    <livewire:create class="\App\Models\Promocode"
        :fields="$fields"
        :types="$types"
        styles="flex-col space-y-2 s"
    />

@endsection

