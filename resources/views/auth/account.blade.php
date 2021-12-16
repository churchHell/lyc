@extends('layouts.app')

@section('app-content')

<div class='space-y-8 m-auto'>

    <livewire:auth.account />
    <livewire:auth.change-password />

</div>

@endsection