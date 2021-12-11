@extends('layouts.app')

@section('app-content')

<div class=" mx-auto">

    <div class="font-bold text-lg text-center">{{ __('password-reset') }}</div>

    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <x-input-block type="email" name="email" value="{{ old('email') }}" class="m" autocomplete=" email"></x-input-block>
        <x-input-block type="password" name="password" class="m"></x-input-block>  
        <x-input-block type="password" name="password_confirmation" class="m"></x-input-block>  

        <div class="flex items-center justify-between">
            <button type="submit" class="m success">
                {{ __('password-reset') }}
            </button>
        </div>
    </form>
    
</div>

@endsection
