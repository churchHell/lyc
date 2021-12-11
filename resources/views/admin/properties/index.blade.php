@extends('admin.layouts.app')

@section('admin-content')

<div class="divide-y">

    <livewire:admin.properties.create />
    <livewire:admin.properties.index />

</div>

@endsection