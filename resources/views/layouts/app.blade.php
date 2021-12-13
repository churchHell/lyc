@extends('layouts.empty')

@section('body')

<header class="divide-y">
    <div class="py-2">
        <div class="container flex flex-col md:flex-row items-center md:items-start justify-between space-y-2 md:space-y-0">
            <div class="flex space-x-8">
                <div class="flex items-center">
                    <i class="fas fa-mobile-alt text-primary"></i>

                    <div class="flex divide-x divide-black">
                        <span class="px-2">{{ renderPhone($settings->get('phone1')->value) }}</span>
                        <span class="px-2">{{ renderPhone($settings->get('phone2')->value) }}</span>
                    </div>
                </div>
                <div class="">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                    <span class="px-2">{{ $settings->get('address1')->value }}</span>
                </div>
            </div>

            <div class="flex divide-x divide-black">
                <a class="px-2" href="{{ route('index') }}">{{ __('main') }}</a>
                @guest
                <a class="px-2" href="{{ route('login') }}">{{ __('login') }}</a>
                <a class="px-2" href="{{ route('register') }}">{{ __('register') }}</a>
                @else
                <a href="{{ route('account') }}" class="px-2">{{ __('account') }}</a>
                <a class="px-2" href="{{ route('logout') }}">{{ __('logout') }}</a>  
                @if(auth()->user()->isAdmin())
                <div class="px-2">
                    <a href="{{ route('admin.orders.index') }}">{{ __('admin-page') }}</a>
                </div>
                @endif
                @endguest
            </div>
        </div>

    </div>
    <div class="py-2">
        <div class="flex justify-between items-center container">
            <a href="{{ route('index') }}">
                <img src="{{ Storage::url('logo.png') }}" class="h-20" alt="">
            </a>
            <livewire:cart.icon/>
        </div>
    </div>
</header>

<section class="container flex flex-grow flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 space-x-0 md:space-x-4">

    @yield('app-content')

</section>

@include('parts.footer')

@endsection