@extends('layouts.app')

@section('app-content')
<div class="mx-auto">
    <div class="font-bold text-lg text-center">{{ __('password-reset') }}</div>

    <div class="flex flex-col space-y-4">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col space-y-4">
            @csrf

            <div class="flex flex-col">
                <span>{{ __('email') }}:</span>
                <x-input type="email" placeholder="{{ __('email') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="m"></x-input>
            </div>

            <button type="submit" class="m success">
                {{ __('send-email') }}
            </button>
        </form>
    </div>

</div>
@endsection
