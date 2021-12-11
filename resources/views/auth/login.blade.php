@extends('layouts.app')

@section('app-content')
<div class=" mx-auto">

    <div class="font-bold text-lg text-center">{{ __('login') }}</div>

    <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-4">
        @csrf

        <x-input-block type="email" name="email" value="{{ old('email') }}" class="m" autocomplete="email"></x-input-block>

        <x-input-block type="password" name="password" class="m"></x-input-block>  

        <div class="flex items-center space-x-2">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <div>
                {{ __('remember-me') }}
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="m success">
                {{ __('login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="" href="{{ route('password.request') }}">
                {{ __('forgot-password') }}
            </a>
            @endif
        </div>
    </form>
    
</div>
@endsection
