@extends('layouts.app')

@section('app-content')

    <div class="w-full md:w-1/6">
        @include('parts.categories')
    </div>

    <div class="w-full md:w-5/6">
        @yield('content')
    </div>

    

@endsection

@include('cookieConsent::index')
