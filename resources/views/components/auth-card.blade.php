@props(['title' => null, 'action'])

<div class="mx-auto">

    @if($title)
        <div class="title">{{ __($title) }}</div>
    @endif

    <form method="POST" action="{{ route($action) }}" class="flex flex-col space-y-4">
        @csrf

        {{ $slot }}

    </form>

</div>