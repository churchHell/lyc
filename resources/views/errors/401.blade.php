@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message')
    {{ __('Unauthorized')}}
    <a href="{{ route('login') }}" title="{{ __('login') }}" class="underline hover:no-underline">{{ __('login') }}</a>
@endsection
