@extends('admin.layouts.app')

@section('admin-content')

    <livewire:admin.items.edit :defaultCategory="$category"/>

@endsection