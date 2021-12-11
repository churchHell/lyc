@extends('admin.layouts.app')

@section('admin-content')

    <livewire:admin.items.edit :itemId="$id"/>

@endsection