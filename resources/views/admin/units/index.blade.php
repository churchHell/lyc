@extends('admin.layouts.app')

@section('admin-content')

<div class="divide-y">

    <livewire:admin.units.create />
    <livewire:admin.units.index />

</div>

@endsection