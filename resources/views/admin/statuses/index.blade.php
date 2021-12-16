@extends('admin.layouts.app')

@section('admin-content')

<div class="divide-y">

    <livewire:admin.statuses.create />
    <livewire:admin.statuses.index />

</div>

@endsection